<?php
  require "header.php";
?>
<main>
  <div class="change-tbl">
    <form action="" method="post">
      <table>
        <tr>
          <td> Select a Type of User to Create </td>
          <td><input type="radio" name="user" value="faculty">Faculty</td>
          <td><input type="radio" name="user" value="student">Student</td>
          <td><input type="radio" name="user" value="alumni">Alumnus</td>
          <td><input type="radio" name="user" value="applicant">Applicant</td>
        </tr>
        <tr>
          <td><button type="submit" name="user-choice">Select</button></td>
        </tr>
      </table>
    </form>

  <?php
    if(isset($_POST['user-choice'])){
      if($_POST['user'] == "faculty"){
        require "creates/faculty.php";
      }
      if($_POST['user'] == "student"){
        require "creates/student.php";
      }
      if($_POST['user'] == "alumni"){
        require "creates/alumni.php";
      }
      if($_POST['user'] == "applicant"){
        require "creates/applicant.php";
      }
    }
  ?>
  </div>
</main>

<?php
  require "footer.php";
?>
