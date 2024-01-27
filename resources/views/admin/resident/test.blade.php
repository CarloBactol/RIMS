@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-4">
              <!-- List group -->
                <div class="list-group" id="myList" role="tablist">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#barangay" role="tab">Barangay Clearance</a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#profile" role="tab">Profile</a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#messages" role="tab">Messages</a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#settings" role="tab">Settings</a>
                </div>
            </div>
            <div class="col-8">
              <!-- Tab panes -->
            <div class="tab-content">
               
                <div class="tab-pane active" id="barangay" role="tabpanel">
                    <div class="container-fluid">
                        <p style="text-align: center;"><strong>Republic of the Philippines</strong></p>
                        <p style="text-align: center;">Province/City/Municipality</p>
                        <p style="text-align: center;">Barangay ______________</p>
                        <p style="text-align: center;"><strong>OFFICE OF THE PUNONG BARANGAY</strong></p>
                        <br>
                        <p style="text-align: center;"><strong>BARANGAY CLEARANCE</strong></p>
                        <br>
                        <p>TO WHOM IT MAY CONCERN:</p>
                        <p>This is to certify that Mr./Ms. {{Str::ucfirst($resident->firstName) . " " . Str::ucfirst($resident->lastName)}}, [Age], [Civil Status], Filipino, and a resident of {{$resident->address}}, Barangay [Barangay Name], [City/Municipality], [Province], has been cleared of any derogatory records and is hereby granted this Barangay Clearance.</p>
                        <p>This certification is being issued upon the request of the above-named individual for [purpose of the clearance].</p>
                        <p>This Barangay Clearance is valid until [expiry date, if applicable].</p>
                        @php
                            $day = "";
                            $month = "";
                            $year = "";
                            $now = Carbon\Carbon::now();
                            $day = $now->day;     // or $now->day()
                            $month = $now->month; // or $now->month()
                            $year = $now->year;   // or $now->year()
                        echo `<p>Issued this {{  $day }} day of [Month], [Year], at Barangay [Barangay Name].</p>`;
                        @endphp
                        <br>
                        <div style="text-align: center;">
                            <div style="display: inline-block; text-align: left;">
                                <p>_____________________<br><strong>[Signature of Punong Barangay]</strong><br>Punong Barangay</p>
                            </div>
                            <div style="display: inline-block; text-align: left; margin-left: 50px;">
                                <p>_____________________<br><strong>[Signature of Barangay Secretary]</strong><br>Barangay Secretary</p>
                            </div>
                        </div>
                        <br>
                        <button id="bcPDF">Generate PDF</button>   
                    </div>
                </div>

                <div class="tab-pane" id="profile" role="tabpanel">Profile</div>
                <div class="tab-pane" id="messages" role="tabpanel">aaa</div>
                <div class="tab-pane" id="settings" role="tabpanel">..aass.</div>
            </div>
            </div>
          </div>
  
    @endsection

    @section('scripts')


        <!-- Include pdfmake from CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

        <script>
        $(document).ready( function () {

            $('#myList a').on('click', function (e) {
                e.preventDefault()
                $(this).tab('show')
            })

            $('#myList a[href="#profile"]').tab('show') // Select tab by name
            $('#myList a:first-child').tab('show') // Select first tab
            $('#myList a:last-child').tab('show') // Select last tab
            $('#myList a:nth-child(3)').tab('show') // Select third tab


            // Generate BC
            function generatePDF() {

                // collection
                var user = @json($resident);
                console.log(typeof user); // Log the type of user
                console.log(user.firstName);
                // Get HTML content
                // const pdfContent = document.getElementById('pdfContent').innerHTML;

                // Create PDF document definition
                const documentDefinition = {
                    content: [{
                            text: 'Republic of the Philippines',
                            style: 'header'
                        },
                        {
                            text: 'Province/City/Municipality',
                            style: 'header2'
                        },
                        {
                            text: `Name: ${user.firstName}`,
                            style: 'header2'
                        },
                        // ... other content
                        //  { text: pdfContent, margin: [0, 20] },
                    ],
                    styles: {
                        header: {
                            display: "flex",
                            flexDirection: "center",
                            fontSize: 18,
                            bold: true,
                            margin: [0, 0, 0, 10],
                            alignment: "center",

                        },
                        header2: {
                            display: "flex",
                            flexDirection: "center",
                            fontSize: 15,
                            bold: false,
                            margin: [0, 0, 0, 10],
                            alignment: "center",

                        },
                        // ... other styles
                    },
                };

                // Generate PDF
                pdfMake.createPdf(documentDefinition).open();
            }

            $('#bcPDF').click(function (e) { 
                e.preventDefault();
                generatePDF();
            });

          }


         );



            
        </script>
    @endsection
