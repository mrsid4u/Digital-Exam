<?php session_start(); ?>
<?php include 'header.php'; ?>
   
<div class="container">


      <div id="adminTopDiv">
          <?php
	          include("adminMenu.php");
	       ?>        
      </div><!--end of topDiv-->
    
      <div id="adminBottomDiv">

<?php
 $con=@mysql_connect("127.0.0.1","root","");
   @mysql_select_db("digitalexam",$con);
   
   
   $totalRecPerPage=10;
   
   $rs=mysql_query("select count(*) from quiz_info");
   
   $row=mysql_fetch_array($rs);
   
   $totalRec=$row[0];

   $noOfPages=ceil($totalRec/$totalRecPerPage);
    
   if(isset($_REQUEST['pgno']))
   {
	  $start=   ($_REQUEST['pgno']-1) * $totalRecPerPage;
   }
   else
   {
	  $start=0;   
   }
   
   
   
   $rs=mysql_query("select * from quiz_info order by quizname limit $start , $totalRecPerPage ");
   $sl=0;
   echo("<table border='1' id='quiztable' cellpadding='10px' cellspacing='0px'>");
   
 echo("<tr>");
      echo("<th>");
      echo("Sr No");
      echo("</th>");

      echo("<th>");
      echo("Quiz Name");
      echo("</th>");

      echo("<th>");
      echo("Total Ques");
      echo("</th>");

     echo("<th>");
     echo("Status");
     echo("</th>");
 echo("</tr>");
   
   
   
   while($row=mysql_fetch_array($rs))
   {
 
    echo("<tr>");
         echo("<td>");
              echo(($start++)+1);
         echo("</td>");

         echo("<td>");
              echo($row["quizname"]);
         echo("</td>");

         echo("<td>");
              echo($row["quiztotalq"]);
         echo("</td>");

         echo("<td>");
         $qid=$row["quizid"];  
               echo("<a href='deletequiz.php?qid=$qid' >Delete</a>");
         echo("</td>");
    echo("</tr>");
    



   }
   echo("</table>");
   
   
   echo("<div id='pagingno'>");
   for($i=1;$i<=$noOfPages;$i++)
   {
       
	   echo("<a href='adminHome.php?pgno=$i'>".$i."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
       
    }
    echo("</div>");
   
?>



</div><!--end of bottomDiv-->

          
</div><!--end of container1-->
<?php include 'footer.php'; ?>
