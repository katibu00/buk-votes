
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
                <h2 style="text-transform: uppercase;"><strong>Bayero Univerity Kano</strong></h2>
                <h3 style="margin-top: -15px;"><strong>Deanary of Student Affairs</strong></h3>

            </td>

           </tr>
       </table>
       <div style="margin-top: -30px;">
        <h5 style="text-transform: uppercase; text-align: center; border-bottom: 2px solid black; padding:5px;">{{$election->title}} General Election</h5>
       </div>
    </div>


    <div style="width: 100%">
        <div style="width: 50%; float: left;">

               <p style="margin-top: -15px;"><strong>Election Title: </strong>{{$election->title}}</p>
               @php
                   $posts = App\Models\Forms::where('election_id',$election->id)->get()->count();
                   if($election->sra == 'all'){
                       $posts += 2;
                   }
                   if($election->sra == 'one'){
                       $posts += 1;
                   }
                   $interests_exco = App\Models\FormCheck::where('election_id',$election->id)->get()->count();
                   $interests_sra = App\Models\SRACandidates::where('election_id',$election->id)->get()->count();

                   $paid_exco = App\Models\FormCheck::where('election_id',$election->id)->where('payment',1)->get()->count();
                   $paid_sra = App\Models\SRACandidates::where('election_id',$election->id)->where('payment',1)->get()->count();
               @endphp
               <p style="margin-top: -15px; "><strong>Number of Posts: </strong> {{$posts}}</p>
               <p style="margin-top: -15px;"><strong>SRA: </strong> @if($election->sra == 'none') Not Enabled @elseif($election->sra == 'one') Departmental Senators Only @elseif($election->sra == 'all') Faculty & Departmental Senators @endif </p>
        </div>

        <div style="width: 10%; float: left; margin-left: 0px;">

        </div>

        <div style="width:40%; float: right;">

            <p style="margin-top: -15px;"><strong>Interests Declared: </strong>{{$interests_exco+$interests_sra}}</p>
            <p style="margin-top: -15px; "><strong>Forms Bought: </strong>{{$paid_exco+$paid_sra}} </p>

        </div>
    </div>

    {{-- <div style="width: 100%; clear: both; overflow: auto; border-top: 2px solid black;">
        <h2 style="font-size: 20px; text-align: center; text-transform: uppercase;">2020/2021 </h2>

    </div> --}}
    <div style="border:  2px solid black; width: 100%; clear: both; overflow: auto;">
        <p style="font-size: 14px; text-align: center;">ALL FEES ARE NOT REFUNDABLE AFTER PAYMENT</p>
    </div>

    <div style="width: 100%; overflow: auto; clear:both; margin-top: 15px;">
        <div style="width: 90%; margin: 0 auto;">
            <table border="1" width="100%" cellpadding="1" cellspacing="2" style="margin-top: 0px;">
                @php
                    $posts = App\Models\Forms::where('election_id',$election->id)->get();
                    $last =0;
                    $total = 0;
                @endphp
                <thead>
                    <tr>
                        <th style="width: 7%;">S/N</th>
                        <th style="width: 20%;">Post</th>
                        <th style="width: 7%;">S/N</th>
                        <th style="width: 30%;">Contestant</th>
                        <th style="width: 15%;">Payment</th>
                        <th style="width: 30%;">Received By</th>



                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($posts as $key => $post)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td colspan="5" style="font-size: 17px;"><strong>{{$post['position']['name']}}</strong></td>


                    </tr>
                    @php
                    $contestants = App\Models\FormCheck::where('election_id',$election->id)->where('post_id',$post['position']['id'])->get();
                @endphp
                @foreach ($contestants as $num => $contestant)
                    <tr>

                        <td></td>
                        <td></td>
                        <td class="text-center">{{$num+1}}</td>
                        <td>{{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}</td>
                        <td class="text-center">{{ $contestant->payment == 1? $post->price: '' }}</td>
                        <td class="">{{ $contestant['receive']['first_name']}} {{ $contestant['receive']['last_name']}}</td>
                        @if($contestant->payment == 1)
                        @php
                            $total += $post->price;
                        @endphp
                        @endif
                    </tr>

                @endforeach

                    @endforeach
                    @php
                    $last += $key;
                @endphp
                {{-- SRA --}}
                    {{-- Faculty --}}
                @if($election->sra == 'all')
                    @php
                        $posts = App\Models\SRAForm::where('election_id',$election->id)->where('type','faculty')->get();
                        $final = 0;
                    @endphp

                        @foreach ($posts as $key => $post)
                        <tr>
                            <td>{{$last+2}}</td>
                            <td colspan="5" style="font-size: 17px;"><strong>Faculty Senator</strong></td>


                        </tr>
                        @php
                         $contestants = App\Models\SRACandidates::where('election_id',$election->id)->where('type','faculty')->get();
                        @endphp
                    @foreach ($contestants as $num => $contestant)
                        <tr>

                            <td></td>
                            <td></td>
                            <td class="text-center">{{$num+1}}</td>
                            <td>{{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}</td>
                            <td class="text-center">{{ $contestant->payment == 1? $post->price: '' }}</td>
                            <td class="">{{ $contestant['receive']['first_name']}} {{ $contestant['receive']['last_name']}}</td>
                        </tr>
                        @if($contestant->payment == 1)
                        @php
                            $total += $post->price;
                        @endphp
                        @endif

                    @endforeach
                        @php
                            @$final +=$last;
                        @endphp
                        @endforeach
                 @endif

                 {{-- departmental --}}
                 @if($election->sra == 'one' || $election->sra == 'all')
                 @php
                     $posts = App\Models\SRAForm::where('election_id',$election->id)->where('type','department')->get();

                 @endphp


                     <tr>
                         <td>{{@$final+3}}</td>
                         <td colspan="5" style="font-size: 17px;"><strong>Departmental Senator</strong></td>


                     </tr>
                     @php
                        $contestants = App\Models\SRACandidates::where('election_id',$election->id)->where('type','department')->get();
                    @endphp
                 @foreach ($contestants as $num => $contestant)
                     <tr>

                         <td></td>
                         <td></td>
                         <td class="text-center">{{$num+1}}</td>
                         <td>{{$contestant['user']['first_name']}} {{$contestant['user']['middle_name']}} {{$contestant['user']['last_name']}}</td>
                         <td class="text-center">{{ $contestant->payment == 1? $post->price: '' }}</td>
                         <td class="">{{ $contestant['receive']['first_name']}} {{ $contestant['receive']['last_name']}}</td>
                     </tr>
                     @if($contestant->payment == 1)
                     @php
                         $total += $post->price;
                     @endphp
                     @endif

                 @endforeach

              @endif
              <tr>

                <td colspan="3"></td>
                <td colspan="2"><strong>Total Amount</strong></td>

                <td class="text-center"><strong>N{{number_format($total,0)}}</strong></td>
            </tr>
            <tr>

                     @php
                        $settings = App\Models\Settings::where('id',1)->first();
                        $com = $settings->commission;
                    @endphp

                <td colspan="3"></td>
                <td colspan="2"><strong>Commission ({{$com}}%)<strong></td>

                <td class="text-center"><strong>N{{number_format($total*$com/100,0)}}</strong></td>
            </tr>
                </tbody>
            </table>
        </div>

            <div style="width: 90%; margin: 0 auto; overflow: auto; clear:both; margin-top: 30px;">

                    {{-- <p style="margin-top: -15px; text-align: center;"><strong>Instructions</strong></p>
                    <li><p style="margin-top: -15px;">Login to your dashboard and confirm the payment details.</p></li>
                    <li><p style="margin-top: -15px;">Make the payment to our Account Number and send us Notification</p></li>
                    <li><p style="margin-top: -15px;">After processing your payment, log back to your dashboard to generate your receipt.</p></li> --}}

            </div>


        </div>
    </div>
    {{-- <div style=" width: 100%; overflow: auto; clear:both; margin-top: 10px;">
        <div style="width: 20%; float: left; text-align: center;">
            <img src="{{public_path('/uploads/qr-code.png')}}" style="width: 80px; height: 80px;">
        </div>

        <div style="width: 80%; float: right;">
            <h2 style="font-size: 23px; text-align: center">This Payment Schedule is Valid up to the midnight</h2>
        </div>
    </div> --}}

    <div style=" width: 100%; margin-top: -10px; clear: both;">

    </div>
    <div style=" width: 100%; margin-top: -20px;">
        <p style="font-size: 13px; text-align: center">Generated on {{date("l, jS \of F Y ")}} @ {{date("h:i A")}}</p>
    </div>

</div>
</body>

</html>

