
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Report</title>

    <style type="text/css">
        table{
            border-collapse: collapse;
        }
        h2 h3{
            margin: 0;
            padding: 0;
        }
        .table{
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }
        .table th,
        .table td{
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th{
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table tbody + tbody{
            border-top: 2px solid #dee2e6;
        }
        .table .table{
            background-color: #fff;
        }
        .table-bordered{
            border: 1px solid #dee2e6;
        }
        .table-bordered th,
        .table-bordered td{
            border: 1px solid #dee2e6;
        }
        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
        .text-left{
            text-align: left;
        }
        table tr td{
            padding: 5px;
        }
        .table-bordered thead th, .table-bordered td, .table-bordered th{
            border: 1px solid black !important;
        }
        .table-bordered thead th{
            background-color: #cacaca;
        }

    </style>
</head>
<body>
<div class="container" style="margin-top: -30px;">
<div class="row">
    <div class="col-md-12">
       <table width="100%">
           <tr>
               <td class="text-center" width="15%">
                   <img  src="{{public_path('/uploads/logo.png')}}" style="width: 100px; height: 100px;">
               </td>
               <td class="text-center" width="85%">
                <h2 style="text-transform: uppercase;"><strong>Bayero Univerity kano</strong></h2>
                <h3 style="margin-top: -15px;"><strong>Student Affairs Division</strong></h3>

            </td>

           </tr>
       </table>
       <div style="margin-top: -30px;">
        <h5 style="text-transform: uppercase; text-align: center; border-bottom: 2px solid black; padding:5px;">Offline Election Request Form</h5>
       </div>
    </div>


    <div style="width: 100%">
        <div style="width: 50%; float: left;">

               <p style="margin-top: -15px;">Election Title: ___________________________ </p>
               <p style="margin-top: -15px; ">Start Date: ______________________________</p>
               <p style="margin-top: -15px; ">Start Time: _____________________________</p>


        </div>


        <div style="width:45%; float: right;">
            <p style="margin-top: -15px; ">End Date: __________________________</p>
            <p style="margin-top: -15px; ">End Time: __________________________</p>



        </div>
    </div>


    <div style="margin-top: -60px;clear:both; margin-bottom: 20px;">
        <p style="text-transform: uppercase; text-align: center; border-bottom: 2px solid black; padding:5px; margin-top: -10px;">Eligibility</p>
       </div>


       <div style="width: 100%;">
        <div style="width: 50%; float: left;">

               <p style="margin-top: -15px;">Faculty: ___________________________ </p>
               <p style="margin-top: -15px; ">Department: _______________________</p>



        </div>


        <div style="width:45%; float: right;">

            <p style="margin-top: -15px;">States: ________________________ </p>
            <p style="margin-top: -15px; ">LGA: _________________________</p>



        </div>
    </div>


    <div style="margin-top: -10px;clear:both; margin-bottom: 20px;">
        <p style="text-transform: uppercase; text-align: center; border-bottom: 2px solid black; padding:5px; margin-top: -10px;">Sales of Forms</p>
       </div>


       <div style="width: 100%;">


         <p style="margin-bottom: 30px; margin-top: -10px;">Start Date: _____________________________ End Date: ________________________________________</p>

        <div style="width:100%; clear:both; margin-top: -30px;">
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>
            <p>Post: __________________________________ Level: ________ CGPA: __________ Price: ____________</p>

        </div>

    </div>

    <div style="margin-top: -20px;clear:both; margin-bottom: 20px;">
        <p style="text-transform: uppercase; text-align: center; border-bottom: 2px solid black; padding:5px; ">ELCOM</p>
       </div>

       <div style="width: 100%;">
        <div style="width: 100%; ">

               <p style="margin-top: px;">ELCOM Name: ___________________________ </p>

        </div>



        <div style="width: 100%; ">

            <p style="margin-top: px;">Members Reg Number (Seperated by comma):  ________________________________________________________________________________________ </p>

     </div>




    </div>


</div>
</body>
</html>

