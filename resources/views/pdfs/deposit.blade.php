
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deposit Slip</title>

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
@php
    $interests = App\Models\FormCheck::where('user_id',Auth::user()->id)->where('payment',0)->where('election_id','!=',0)->get();
@endphp

@if($interests->count() > 0)
@foreach ($interests as $user)
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
        <h5 style="text-transform: uppercase; text-align: center; border-bottom: 2px solid black; padding:5px;">{{$user['election']['title']}} - EXCO Aspiration Form</h5>
       </div>
    </div>


    <div style="width: 100%">
        <div style="width: 50%; float: left;">

               <p style="margin-top: -15px;"><strong>Election Title: </strong>{{$user['election']['title']}}</p>
               <p style="margin-top: -15px; "><strong>Post Declared: </strong>{{$user['position']['name']}}</p>
               @php
                   $post = App\Models\Forms::where('election_id',$user['election']['id'])->where('post_id',$user['position']['id'])->first();
               @endphp
               <p style="margin-top: -15px; "><strong>Minimun CGPA Required: </strong>{{@$post->cgpa}}</p>
               <p style="margin-top: -15px; "><strong>Minimun Level Required: </strong>{{@$post->level}}00 Level</p>
               <p style="margin-top: -15px; "><strong>Form Price: </strong>N{{number_format(@$post->price,0)}}</p>
               <p style="margin-top: -15px; "><strong>Closing Date: </strong>{{\Carbon\Carbon::parse(@$post->end_date)->format('l, jS M Y')}}</p>
        </div>

        <div style="width: 15%; float: left; margin-left: 0px;">

        </div>

        <div style="width:45%; float: right;">
            @php
            $election = App\Models\Election::where('id',$user['election']['id'])->first();
        @endphp

            <p style="margin-top: -15px;"><strong>Election Committe: </strong>{{$election['elcom']['name']}}</p>
            <p style="margin-top: -15px; "><strong>Contact Phone: </strong>{{@$election->phone}}</p>
            <p style="margin-top: -15px; "><strong>Contact Email: </strong>{{@$election->email}}</p>
            <p style="margin-top: -15px; "><strong>Contact Address: </strong>{{@$election->address}}</p>


        </div>
    </div>

    <div style="margin-top: -500px; clear: both; overflow: hidden; ">
        <h5 style="text-transform: uppercase; text-align: center; border-bottom: 2px solid black; padding:5px;margin-top: -10px; ">Procedure and Guides</h5>
    </div>

    <ol>
        <li>You are required to pay a sum of N{{number_format(@$post->price,0)}} to the following acount:
            <ul>
                <li>Account Name: {{@$election->account_name}}</li>
                <li>Account Number: {{@$election->account_number}}</li>
            </ul>
        </li>
        <li>You will not be able to vote in any election unless you make at least one payment</li>
        <li>You must satisfy with all the election requirement before you will be qualified</li>
        <li>You may be disqualified if at any time, even while in office, it is discovered that there is falsification in the information you provided.</li>
        <li>You will abide by the University rules governing the conduct of election.</li>
    </ol>

    <div style="border:  2px solid black; width: 100%; clear: both; overflow: auto; margin-top: 20px;">
        <p style="font-size: 14px; text-align: center;">ALL FEES ARE NOT REFUNDABLE AFTER PAYMENT</p>
    </div>

    <div style="width: 100%; overflow: auto; clear:both; margin-top: 15px;">
        <div style="width: 80%; margin: 0 auto;">

        </div>

            <div style="width: 90%; margin: 0 auto; overflow: auto; clear:both; margin-top: 30px;">



            </div>


        </div>
    </div>


    <div style=" width: 100%; margin-top: -10px; clear: both;">

    </div>
    <div style=" width: 100%; margin-top: -20px;">
        <p style="font-size: 13px; text-align: center">Generated on {{date("l, jS \of F Y ")}} @ {{date("h:i A")}}</p>
    </div>

</div>
</body>
@endforeach
@endif

@php
    $sras = App\Models\SRACandidates::where('user_id',Auth::user()->id)->where('payment',0)->get();
@endphp

@if($sras->count() > 0)
@foreach ($sras as $user)

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
        <h5 style="text-transform: uppercase; text-align: center; border-bottom: 2px solid black; padding:5px;">{{$user['election']['title']}} - SRA Aspiration Form</h5>
       </div>
    </div>


    <div style="width: 100%">
        <div style="width: 50%; float: left;">

               <p style="margin-top: -15px;"><strong>Election Title: </strong>{{$user['election']['title']}}</p>
               <p style="margin-top: -15px; "><strong>Post Declared: </strong>{{$user->type == 'department'?'Departmental Senator':'Faculty Senator'}}</p>
               @php
                   $post = App\Models\SRAForm::where('election_id',$user['election']['id'])->where('type', $user->type)->first();
               @endphp
               <p style="margin-top: -15px; "><strong>Minimun CGPA Required: </strong>{{@$post->cgpa}}</p>
               <p style="margin-top: -15px; "><strong>Minimun Level Required: </strong>{{@$post->level}}00 Level</p>
               <p style="margin-top: -15px; "><strong>Form Price: </strong>N{{number_format(@$post->price,0)}}</p>
               <p style="margin-top: -15px; "><strong>Closing Date: </strong>{{\Carbon\Carbon::parse(@$post->end_date)->format('l, jS M Y')}}</p>
        </div>

        <div style="width: 15%; float: left; margin-left: 0px;">

        </div>

        <div style="width:45%; float: right;">
            @php
            $election = App\Models\Election::where('id',$user['election']['id'])->first();
        @endphp

            <p style="margin-top: -15px;"><strong>Election Committe: </strong>{{$election['elcom']['name']}}</p>
            <p style="margin-top: -15px; "><strong>Contact Phone: </strong>{{$election->phone}}</p>
            <p style="margin-top: -15px; "><strong>Contact Email: </strong>{{$election->email}}</p>
            <p style="margin-top: -15px; "><strong>Contact Address: </strong>{{$election->address}}</p>


        </div>
    </div>

    <div style="margin-top: -500px; clear: both; overflow: hidden; ">
        <h5 style="text-transform: uppercase; text-align: center; border-bottom: 2px solid black; padding:5px;margin-top: -10px; ">Procedure and Guides</h5>
    </div>

    <ol>
        <li>You are required to pay a sum of N{{number_format(@$post->price,0)}} to the following acount:
            <ul>
                <li>Account Name: {{$election->account_name}}</li>
                <li>Account Number: {{$election->account_number}}</li>
            </ul>
        </li>
        <li>You will not be able to vote in any election unless you make at least one payment</li>
        <li>You must satisfy with all the election requirement before you will be qualified</li>
        <li>You may be disqualified if at any time, even while in office, it is discovered that there is falsification in the information you provided.</li>
        <li>You will abide by the University rules governing the conduct of election.</li>
    </ol>

    <div style="border:  2px solid black; width: 100%; clear: both; overflow: auto; margin-top: 20px;">
        <p style="font-size: 14px; text-align: center;">ALL FEES ARE NOT REFUNDABLE AFTER PAYMENT</p>
    </div>

    <div style="width: 100%; overflow: auto; clear:both; margin-top: 15px;">
        <div style="width: 80%; margin: 0 auto;">

        </div>

            <div style="width: 90%; margin: 0 auto; overflow: auto; clear:both; margin-top: 30px;">



            </div>


        </div>
    </div>

    <div style=" width: 100%; margin-top: -10px; clear: both;">

    </div>
    <div style=" width: 100%; margin-top: -20px;">
        <p style="font-size: 13px; text-align: center">Generated on {{date("l, jS \of F Y ")}} @ {{date("h:i A")}}</p>
    </div>

</div>
</body>
@endforeach
@endif
</html>

