@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- List group -->
                <div class="list-group" id="myList" role="tablist">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#barangay"
                        role="tab">Barangay Clearance</a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#residency"
                        role="tab">Certicate Of Residency</a>

                    @if (!empty($resident->business->id))
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#business"
                            role="tab">Permit To Operate</a>
                    @endif
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#indigency"
                        role="tab">Indigency</a>
                </div>
            </div>
            <div class="col-md-8">
                <!-- Tab panes -->
                <div class="tab-content">

                    {{-- barangay clearance --}}
                    <div class="tab-pane active" id="barangay" role="tabpanel">
                        <div class="container-fluid">
                            <h4>Barangay Clearance</h4>
                            <br>
                            <button id="bcPDF" class="btn btn-primary btn-outline">Generate PDF</button>
                        </div>
                    </div>

                    {{-- certicate of residency --}}
                    <div class="tab-pane" id="residency" role="tabpanel">
                        <div class="container-fluid">
                            <h4>Certicate Of Residency</h4>
                            <br>
                            <button id="crPDF" class="btn btn-primary btn-outline">Generate PDF</button>
                        </div>
                    </div>

                    {{-- business permit --}}
                    <div class="tab-pane" id="business" role="tabpanel">
                        <div class="container-fluid">
                            <h4>Permit To Operate</h4>
                            <br>
                            <button id="businessPermitPDF" class="btn btn-primary btn-outline">Generate PDF</button>
                        </div>
                    </div>

                    {{-- indigency certificate --}}
                    <div class="tab-pane" id="indigency" role="tabpanel">
                        <div class="container-fluid">
                            <h4>Indigency Certificate</h4>
                            <br>
                            <button id="indigencyPDF" class="btn btn-primary btn-outline">Generate PDF</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Include pdfmake from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {


            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            // ... Your existing document ready code
            $('#myList a').on('click', function(e) {
                e.preventDefault()
                $(this).tab('show')
            })

            $('#myList a[href="#barangay"]').tab('show') // Select tab by name
            // $('#myList a:first-child').tab('show') // Select first tab
            // $('#myList a:last-child').tab('show') // Select last tab
            // $('#myList a:nth-child(3)').tab('show') // Select third tab

            // Barangay Clearance
            async function generatePDFBarangayClearance() {
                var currentDate = new Date();
                var twoWeeksLater = new Date();
                twoWeeksLater.setDate(currentDate.getDate() + 14);

                var user = @json($resident);
                var captain = @json($captain);
                var secretary = @json($secretary);

                // Formatting the result
                var formattedDate = twoWeeksLater.toLocaleDateString("en-PH", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                });

                var dateNow = currentDate.toLocaleDateString("en-PH", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                });
                var dateNow2 = currentDate.toLocaleDateString("en-PH", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                });

                var monthDay = currentDate.toLocaleDateString("en-PH", {
                    month: "long",
                    day: "numeric",
                });
                var year1 = currentDate.toLocaleDateString("en-PH", {
                    year: "numeric",
                });
                var days = currentDate.toLocaleDateString("en-PH", {
                    day: "numeric",
                });
                var month = currentDate.toLocaleDateString("en-PH", {
                    month: "long",
                });

                let pColor = '#4b4b4b';
                let fSize = "15";

                // BC
                var documentDefinition = {
                    background: {
                        image: await getBase64ImageFromURL("{{ asset('images/clearance.png') }}"),
                        width: 595, // Width of the background image (A4 page width)
                        height: 842 // Height of the background image (A4 page height)
                    },
                    content: [{
                            text: monthDay,
                            style: 'date',
                            color: pColor,
                        },
                        {
                            text: year1.toString().slice(-2),
                            style: 'year',
                            color: pColor,
                        },
                        {
                            text: `${user.firstName} ${user.middleName} ${user.lastName}`,
                            style: 'name',
                            color: pColor,
                        },
                        {
                            text: calculateAge(user.dateOfBirth),
                            style: 'age',
                            color: pColor,
                        },
                        {
                            text: `${user.firstName} ${user.middleName} ${user.lastName}`,
                            style: 'name2',
                            color: pColor,
                        },
                        {
                            text: `${user.purpose}`,
                            style: 'purpose',
                            color: pColor,
                        },
                        {
                            text: days,
                            style: 'days',
                            color: pColor,
                        },
                        {
                            text: month,
                            style: 'month',
                            color: pColor,
                        },
                        {
                            text: year1.toString().slice(-2),
                            style: 'year2',
                            color: pColor,
                        },
                        {
                            text: `${user.firstName} ${user.middleName} ${user.lastName}`,
                            style: 'name3',
                            color: pColor,
                        },
                        {
                            text: `${captain.firstName} ${captain.middleName} ${captain.lastName}`,
                            style: 'captain',
                            color: pColor,
                        },
                    ],
                    styles: {
                        header: {
                            alignment: 'center',
                            margin: [0, -45, 0, 0]
                        },
                        date: {
                            position: 'absolute',
                            fontSize: '13',
                            margin: [380, 193, 0, 0]
                        },
                        year: {
                            position: 'absolute',
                            fontSize: '13',
                            margin: [490, -14, 0, 0]
                        },
                        name: {
                            position: 'absolute',
                            fontSize: '15',
                            margin: [300, 72, 0, 0]
                        },
                        age: {
                            position: 'absolute',
                            fontSize: '13',
                            margin: [0, 3, 0, 0]
                        },
                        name2: {
                            position: 'absolute',
                            fontSize: '12',
                            margin: [30, 90, 0, 0]
                        },
                        purpose: {
                            position: 'absolute',
                            fontSize: '12',
                            margin: [30, 3, 0, 0]
                        },
                        days: {
                            position: 'absolute',
                            fontSize: '12',
                            margin: [110, 33, 0, 0]
                        },
                        month: {
                            position: 'absolute',
                            fontSize: '12',
                            margin: [220, -15, 0, 0]
                        },
                        year2: {
                            position: 'absolute',
                            fontSize: '14',
                            margin: [350, -15, 0, 0]
                        },
                        name3: {
                            position: 'absolute',
                            fontSize: '15',
                            margin: [40, 42, 0, 0]
                        },
                        captain: {
                            position: 'absolute',
                            fontSize: '15',
                            margin: [310, 27, 0, 0]
                        },
                        footer: {
                            alignment: 'bottom',
                            margin: [0, 0, -20, 0]
                        }
                    }
                };

                // Generate PDF
                pdfMake.createPdf(documentDefinition).open();
            }

            // Certificate of Residency
            async function generatePDFCerticateResidency() {
                var user = @json($resident);
                var captain = @json($captain);
                var secretary = @json($secretary);
                console.log(secretary);

                var currentDate = new Date();
                var twoWeeksLater = new Date();
                twoWeeksLater.setDate(currentDate.getDate() + 14);

                // Formatting the result
                var formattedDate = twoWeeksLater.toLocaleDateString("en-PH", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                });

                var dateNow = currentDate.toLocaleDateString("en-PH", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                });
                var dateNow2 = currentDate.toLocaleDateString("en-PH", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                });

                var monthDay = currentDate.toLocaleDateString("en-PH", {
                    month: "long",
                    day: "numeric",
                });
                var year1 = currentDate.toLocaleDateString("en-PH", {
                    year: "numeric",
                });
                var days = currentDate.toLocaleDateString("en-PH", {
                    day: "numeric",
                });
                var month = currentDate.toLocaleDateString("en-PH", {
                    month: "long",
                });

                let pColor = '#4b4b4b';
                let fontSize = '15';

                // CR
                var documentDefinition = {
                    background: {
                        image: await getBase64ImageFromURL("{{ asset('images/residency.png') }}"),
                        width: 595, // Width of the background image (A4 page width)
                        height: 842 // Height of the background image (A4 page height)
                    },

                    content: [{
                            text: `${user.firstName} ${user.middleName} ${user.lastName}`,
                            style: 'name',
                            color: pColor,
                        },
                        {
                            text: calculateAge(user.dateOfBirth),
                            style: 'age',
                            color: pColor,
                        },
                        {
                            text: days,
                            style: 'days',
                            color: pColor,
                        },
                        {
                            text: month,
                            style: 'month',
                            color: pColor,
                        },
                        {
                            text: year1.toString(),
                            style: 'year',
                            color: pColor,
                        },
                        {
                            text: `${secretary.firstName} ${secretary.middleName} ${secretary.lastName}`,
                            style: 'secretary',
                            color: pColor,
                        },
                        {
                            text: `${captain.firstName} ${captain.middleName} ${captain.lastName}`,
                            style: 'captain',
                            color: pColor,
                        },
                    ],
                    styles: {
                        name: {
                            position: 'absolute',
                            fontSize: fontSize,
                            margin: [280, 237, 0, 0]
                        },
                        age: {
                            position: 'absolute',
                            fontSize: fontSize,
                            margin: [40, 11, 0, 0]
                        },
                        days: {
                            position: 'absolute',
                            fontSize: fontSize,
                            margin: [149, 106, 0, 0]
                        },
                        month: {
                            position: 'absolute',
                            fontSize: fontSize,
                            margin: [250, -20, 0, 0]
                        },
                        year: {
                            position: 'absolute',
                            fontSize: fontSize,
                            margin: [365, -16, 0, 0]
                        },
                        secretary: {
                            position: 'absolute',
                            fontSize: fontSize,
                            margin: [30, 135, 0, 0]
                        },
                        captain: {
                            position: 'absolute',
                            fontSize: fontSize,
                            margin: [280, 48, 0, 0]
                        },
                    }

                };

                // Generate PDF
                pdfMake.createPdf(documentDefinition).open();
            }


            //  Permit to Operate
            async function generatePDFBusinessPermit() {
                var user = @json($resident);
                var captain = @json($captain);
                var businessInfo = @json($resident->business);
                var treasurer = @json($treasurer);
                var secretary = @json($secretary);

                var currentDate = new Date();
                var oneYearLater = new Date();
                oneYearLater.setFullYear(currentDate.getFullYear() + 1);

                var currentDate = new Date();
                var twoWeeksLater = new Date();
                twoWeeksLater.setDate(currentDate.getDate() + 14);

                var formattedExpiryDate = oneYearLater.toLocaleDateString('en-PH', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });


                var dateNow = currentDate.toLocaleDateString("en-PH", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                });
                var dateNow2 = currentDate.toLocaleDateString("en-PH", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                });

                var monthDay = currentDate.toLocaleDateString("en-PH", {
                    month: "long",
                    day: "numeric",
                });
                var year1 = currentDate.toLocaleDateString("en-PH", {
                    year: "numeric",
                });
                var days = currentDate.toLocaleDateString("en-PH", {
                    day: "numeric",
                });
                var month = currentDate.toLocaleDateString("en-PH", {
                    month: "long",
                });
                let pColor = '#4b4b4b';
                let fSize = '14';

                // Business Permit
                var documentDefinition = {
                    background: {
                        image: await getBase64ImageFromURL("{{ asset('images/permit-to-operate.png') }}"),
                        width: 595, // Width of the background image (A4 page width)
                        height: 842 // Height of the background image (A4 page height)
                    },
                    content: [{
                            text: `${user.firstName} ${user.lastName}`,
                            style: 'name'
                        },
                        {
                            text: `${businessInfo.businessName}`,
                            style: 'bName'
                        },
                        {
                            text: formattedExpiryDate,
                            style: 'expiration'
                        },
                        {
                            text: `${user.firstName} ${user.middleName} ${user.lastName}`,
                            style: 'name2'
                        },
                        {
                            text: `${treasurer.firstName} ${treasurer.middleName} ${treasurer.lastName}`,
                            style: 'treasurer'
                        },
                        {
                            text: `${secretary.firstName}  ${secretary.middleName} ${secretary.lastName}`,
                            style: 'secretary'
                        },
                        {
                            text: `${captain.firstName} ${captain.middleName} ${captain.lastName}`,
                            style: 'captain'
                        },
                    ],
                    styles: {
                        name: {
                            fontSize: fSize,
                            position: 'absolute',
                            margin: [250, 167, 0, 0],
                            color: pColor
                        },
                        bName: {
                            fontSize: '13',
                            position: 'absolute',
                            margin: [90, 5, 0, 0],
                            color: pColor
                        },
                        expiration: {
                            fontSize: '10',
                            position: 'absolute',
                            margin: [235, 63, 0, 0],
                            color: pColor
                        },
                        name2: {
                            fontSize: fSize,
                            position: 'absolute',
                            margin: [210, 142, 0, 0],
                            color: pColor
                        },
                        treasurer: {
                            fontSize: fSize,
                            position: 'absolute',
                            margin: [110, 85, 0, 0],
                            color: pColor
                        },
                        secretary: {
                            fontSize: fSize,
                            position: 'absolute',
                            margin: [380, -14, 0, 0],
                            color: pColor
                        },
                        captain: {
                            fontSize: fSize,
                            position: 'absolute',
                            margin: [335, 82, 0, 0],
                            color: pColor
                        },

                    }
                };

                // Generate PDF
                pdfMake.createPdf(documentDefinition).open();
            }


            // Indigency Certifcate
            async function generatePDFIndigency() {
                var user = @json($resident);
                var captain = @json($captain);
                var secretary = @json($secretary);

                var currentDate = new Date();
                var twoWeeksLater = new Date();
                twoWeeksLater.setDate(currentDate.getDate() + 14);

                // Formatting the result
                var formattedDate = twoWeeksLater.toLocaleDateString("en-PH", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                });

                var dateNow = currentDate.toLocaleDateString("en-PH", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                });
                var dateNow2 = currentDate.toLocaleDateString("en-PH", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                });

                var monthDay = currentDate.toLocaleDateString("en-PH", {
                    month: "long",
                    day: "numeric",
                });
                var year1 = currentDate.toLocaleDateString("en-PH", {
                    year: "numeric",
                });
                var days = currentDate.toLocaleDateString("en-PH", {
                    day: "numeric",
                });
                var month = currentDate.toLocaleDateString("en-PH", {
                    month: "long",
                });

                let pColor = '#4b4b4b';
                let fSize = "15";

                // Indigency Certificate
                var documentDefinition = {
                    background: {
                        image: await getBase64ImageFromURL("{{ asset('images/indigency.png') }}"),
                        width: 595, // Width of the background image (A4 page width)
                        height: 842 // Height of the background image (A4 page height)
                    },

                    content: [{
                            text: `${user.firstName} ${user.middleName} ${user.lastName}`,
                            style: 'name'
                        },
                        {
                            text: calculateAge(user.dateOfBirth),
                            style: 'age'
                        },
                        {
                            text: days,
                            style: 'days'
                        },
                        {
                            text: month,
                            style: 'month'
                        },
                        {
                            text: year1.toString().slice(-2),
                            style: 'year'
                        },
                        {
                            text: `${secretary.firstName} ${secretary.middleName} ${secretary.lastName}`,
                            style: 'secretary',
                            color: pColor,
                        },
                        {
                            text: `${captain.firstName} ${captain.middleName} ${captain.lastName}`,
                            style: 'captain',
                            color: pColor,
                        },
                    ],

                    styles: {
                        name: {
                            position: 'absolute',
                            fontSize: fSize,
                            color: pColor,
                            margin: [300, 296, 0, 0]
                        },
                        age: {
                            position: 'absolute',
                            fontSize: fSize,
                            color: pColor,
                            margin: [40, 4, 0, 0]
                        },
                        days: {
                            position: 'absolute',
                            fontSize: fSize,
                            color: pColor,
                            margin: [160, 125, 0, 0]
                        },
                        month: {
                            position: 'absolute',
                            fontSize: fSize,
                            color: pColor,
                            margin: [300, -15, 0, 0]
                        },
                        year: {
                            position: 'absolute',
                            fontSize: fSize,
                            color: pColor,
                            margin: [440, -17, 0, 0]
                        },
                        secretary: {
                            position: 'absolute',
                            fontSize: '15',
                            margin: [30, 120, 0, 0]
                        },
                        captain: {
                            position: 'absolute',
                            fontSize: '15',
                            margin: [280, 35, 0, 0]
                        },
                    }
                };

                // Generate PDF
                pdfMake.createPdf(documentDefinition).open();
            }


            function calculateAge(birthDate) {
                var today = new Date();
                var birthDate = new Date(birthDate);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }

            function getBase64ImageFromURL(url) {
                return new Promise((resolve, reject) => {
                    var img = new Image();
                    img.setAttribute("crossOrigin", "anonymous");

                    img.onload = () => {
                        var canvas = document.createElement("canvas");
                        canvas.width = img.width;
                        canvas.height = img.height;

                        var ctx = canvas.getContext("2d");
                        ctx.drawImage(img, 0, 0);

                        var dataURL = canvas.toDataURL("image/png");

                        resolve(dataURL);
                    };

                    img.onerror = (error) => {
                        reject(error);
                    };

                    img.src = url;
                });
            }

            // === Buttons Click ===


            $('#bcPDF').click(function(e) {
                e.preventDefault();
                var user = @json($resident);
                if (confirm("Are you sure you want to generate a certificate?")) {
                    // Code to delete the item goes here
                    console.log("Item deleted!");
                    PostLogs(`${user.id}`, "Barangay Clearance")
                    generatePDFBarangayClearance();
                } else {
                    console.log("Deletion canceled.");
                }

                
            });

            $('#crPDF').click(function(e) {
                e.preventDefault();
                var user = @json($resident);
                if (confirm("Are you sure you want to generate a certificate?")) {
                    // Code to delete the item goes here
                    console.log("Item deleted!");
                    PostLogs(`${user.id}`, "Certicate Residency")
                    generatePDFCerticateResidency();
                } else {
                    console.log("Deletion canceled.");
                }
                
            });

            $('#businessPermitPDF').click(function(e) {
                e.preventDefault();
                var user = @json($resident);
                if (confirm("Are you sure you want to generate a certificate?")) {
                    // Code to delete the item goes here
                    console.log("Item deleted!");
                    PostLogs(`${user.id}`, "Permit to Operate");
                    generatePDFBusinessPermit();
                } else {
                    console.log("Deletion canceled.");
                }
                
            });

            $('#indigencyPDF').click(function(e) {
                e.preventDefault();
                var user = @json($resident);
                if (confirm("Are you sure you want to generate a certificate?")) {
                    // Code to delete the item goes here
                    console.log("Item deleted!");
                    PostLogs(`${user.id}`, "Certifacte Indigency");
                    generatePDFIndigency();
                } else {
                    console.log("Deletion canceled.");
                }
                
            });


           function PostLogs(userId, certType){
          
             console.log(userId);
            $.ajax({
                type: "POST",
                url: "{{ route('cert_logs.store') }}",
                data: {user_id: userId, certType: certType},
                success: function (response) {
                    console.log(response.success);
                },
             
            });
           }

        });
    </script>
@endsection
