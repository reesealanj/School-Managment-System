<?php
  $validyrs = "SELECT DISTINCT YEAR(date_received) as date FROM application";
  $runyrs = mysqli_query($conn, $validyrs);
  $table = "<form action='' method='post'>
            <table>
              <tr>
                <td>Select Application Year to Generate List</td>
                <td><select name='yr'>";
        while($row = mysqli_fetch_assoc($runyrs)){
          $table.="<option value={$row['date']}>{$row['date']}</option>";
        }
  $table .= "</select></td></tr>
                <tr>
                  <td><button type='submit' name='gen-stat'>Generate</button></td>
                </tr>
              </table>
            </form>";
  echo $table;
