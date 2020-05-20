<?php
  $_POST['user'] = "admit-stat";
  $validyrs = "SELECT DISTINCT grad_year FROM alumni";
  $run_yrs = mysqli_query($conn, $validyrs);
  $table = "<form action='' method='post'>
            <table>
              <tr>
                <td>Select Graduation Year to Generate List</td>
                <td><select name='yr'>";
        while($row = mysqli_fetch_assoc($run_yrs)){
          $table.="<option value={$row['grad_year']}>{$row['grad_year']}</option>";
        }
  $table .= "</select></td></tr>
                <tr>
                  <td><button type='submit' name='gen-list'>Generate</button></td>
                </tr>
              </table>
            </form>";
  echo $table;
?>
