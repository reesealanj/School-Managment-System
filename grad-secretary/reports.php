<?php
  require "header.php";
?>
<main>
<div class="change-tbl">
  <form action="" method="post">
    <table>
      <tr>
        <td>Select A Report To Generate</td>
        <td><input type="radio" name="user" value="admit-stat">Admission Statistics</td>
        <td><input type="radio" name="user" value="alumni-list">Alumni List</td>
      </tr>
      <tr>
        <th colspan='3'><button type="submit" name="rep-choice">Select</button></th>
      </tr>
    </table>
  </form>
  <?php
    if(isset($_POST['rep-choice'])){
      if($_POST['user'] == "admit-stat"){
        require 'rep-types/applicantstats.php';
      }
      if($_POST['user'] == "alumni-list"){
        require 'rep-types/alumnilist.php';
      }
    }
    if(isset($_POST['gen-list'])){
      $yr = $_POST['yr'];
      echo "<h1>List of Graduates From "  . $yr . "</h1>";
      $yr_query = "SELECT * FROM alumni WHERE grad_year=".$yr;
      $run_year = mysqli_query($conn, $yr_query);
      $table = "<table><tr><th>Name</th><th>Email</th></tr>";
      while($row = mysqli_fetch_assoc($run_year)){
        $table .= "<tr><td>{$row['fname']} {$row['lname']}</td><td>{$row['email']}</td></tr>";
      }
      $table .= "</table>";
      echo $table;
    }
    if(isset($_POST['gen-stat'])){
      $yr = $_POST['yr'];
      echo "<h1>Admission Statistics For " . $yr . "</h1>";
      $yr_query = "SELECT * FROM application WHERE YEAR(date_received)=" . $yr;
      $run_year = mysqli_query($conn, $yr_query);
      $applied = 0;
      $accept = 0;
      $reject = 0;
      $gre_verbal = 0;
      $gre_quant = 0;
      $gre_adv = 0;
      $toefl = 0;
      $m_grev = 0;
      $p_grev =0;
      $m_greq = 0;
      $m_grea = 0;
      $p_greq =0;
      $p_grea = 0;
      $m_toefl = 0;
      $p_toefl = 0;
      $ms = 0;
      $phd = 0;
      while ($row = mysqli_fetch_assoc($run_year)){
        $applied = $applied + 1;
        $uid = $row['uid'];
        $applicant = "SELECT decision FROM applicant WHERE user_id=" . $uid;
        $run_applicant = mysqli_query($conn, $applicant);
        $result = mysqli_fetch_assoc($run_applicant);
        $decision = $result['decision'];
        if(($decision == 1) || ($decision == 2)){
          $accept = $accept + 1;
        }
        else if($decision == 3){
          $reject = $reject + 1;
        }
        if($row['degree_seeking'] == "MS"){
          $m_grev = $m_grev + $row['GRE_verbal'];
          $m_greq = $m_grea + $row['GRE_quantitative'];
          $m_grea = $m_grea + $row['GRE_score'];
          $m_toefl = $m_toefl + $row['TOEFL_score'];
          $ms = $ms + 1;
        }
        if($row['degree_seeking'] == "PHD"){
          $p_grev = $p_grev + $row['GRE_verbal'];
          $p_greq = $p_grea + $row['GRE_quantitative'];
          $p_grea = $p_grea + $row['GRE_score'];
          $p_toefl = $p_toefl + $row['TOEFL_score'];
          $phd = $phd + 1;
        }
        $gre_verbal = $gre_verbal + $row['GRE_verbal'];
        $gre_quant = $gre_quant + $row['GRE_quantitative'];
        $gre_adv = $gre_adv + $row['GRE_score'];
        $toefl = $toefl + $row['TOEFL_score'];
      }

      $table = "<table><tr><th>Total Applicants:</th><td>".$applied."</td></tr>";
      $table .= "<tr><th>Total Admitted:</th><td>".$accept."</td></tr>";
      $table .= "<tr><th>Total Rejected:</th><td>".$reject."</td></tr>";
        $avg_grev = $gre_verbal / $applied;
      $table .= "<tr><th>Average GRE Verbal Score:</th><td>".$avg_grev."</td></tr>";
        $avg_greq = $gre_quant / $applied;
      $table .= "<tr><th>Average GRE Quantitative Score:</th><td>".$avg_greq."</td></tr>";
        $avg_grea = $gre_adv / $applied;
      $table .= "<tr><th>Average GRE Advanced Score:</th><td>".$avg_grea."</td></tr>";
        $avg_toefl = $toefl / $applied;
      $table .= "<tr><th>Average TOEFL Score:</th><td>".$avg_toefl."</td></tr>";
      $table .= "</table>";
      echo $table;
      echo "<h1>Breakdown By Intended Major</h1>";
      $table = "<table><tr><th>Total MS Applicants:</th><td>".$ms."</td></tr>";
        $avg_grev = $m_grev / $ms;
      $table .= "<tr><th>Average GRE Verbal Score:</th><td>".$avg_grev."</td></tr>";
        $avg_greq = $m_greq / $ms;
      $table .= "<tr><th>Average GRE Quantitative Score:</th><td>".$avg_greq."</td></tr>";
        $avg_grea = $m_grea / $ms;
      $table .= "<tr><th>Average GRE Advanced Score:</th><td>".$avg_grea."</td></tr>";
        $avg_toefl = $m_toefl / $ms;
      $table .= "<tr><th>Average TOEFL Score:</th><td>".$avg_toefl."</td></tr>";
      $table .= "</table>";
      echo $table;
      $table = "<table><tr><th>Total PHD Applicants:</th><td>".$phd."</td></tr>";
        $avg_grev = $p_grev / $phd;
      $table .= "<tr><th>Average GRE Verbal Score:</th><td>".$avg_grev."</td></tr>";
        $avg_greq = $p_greq / $phd;
      $table .= "<tr><th>Average GRE Quantitative Score:</th><td>".$avg_greq."</td></tr>";
        $avg_grea = $p_grea / $phd;
      $table .= "<tr><th>Average GRE Advanced Score:</th><td>".$avg_grea."</td></tr>";
        $avg_toefl = $p_toefl / $phd;
      $table .= "<tr><th>Average TOEFL Score:</th><td>".$avg_toefl."</td></tr>";
      $table .= "</table>";
      echo $table;
    }
  ?>
</main>
<?php
  require "footer.php";
?>
