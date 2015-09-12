<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 3/22/12
 * Time: 10:22 PM
 * To change this template use File | Settings | File Templates.
 */


include 'BSSSQLOperation.php';

$configArray = Array();

echo HOST;

echo '1';

mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());

echo '2';

          $result = mysql_query("SELECT width, fieldname FROM TableColumns JOIN Tables ON Tables.id = TableColumns.masterid AND Tables.TableName = 'AAA'");
echo '3';
          $Y = 0;
          while ($row = mysql_fetch_assoc($result)){
          //    echo $Y;
             $Y = $Y + 1;
            // configArray[$Y]->width = 50; //$row["width"];
              echo $row["width"];
           //  $this->configArray[$Y]->field = $row["fieldname"];
           //  $this->configArray[$Y]->heading = $row['heading'];
           //  $this->configArray[$Y]->renderedas = $row['renderedas'];
           //  $this->configArray[$Y]->foreignkeytable = $row['foreignkeytable'];
           //  $this->configArray[$Y]->foreignkey = $row['foreignkey'];
           //  $this->configArray[$Y]->foreignkeyfield = $row['foreignkeyfield'];
           //  $this->configArray[$Y]->defaultvalue = $row['defaultvalue'];

            //  echo $row['field'];
          }

          mysql_free_result($result);

