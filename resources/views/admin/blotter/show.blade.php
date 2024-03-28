@extends('layouts.admin')
{{-- {{ dd($resident) }} --}}
@section('content')
    <div class="container">
        <div class="row">
           <div class="col-md-8">
            <div class="card">
                <div class="card-header">Blotter Info</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="Respondent Name">Respondent Name</label>
                    <input type="text" disabled class=" form-control" value="{{ Str::ucfirst($blotters->respondent->firstName) . "  ". Str::ucfirst($blotters->respondent->middleName) . "  " . Str::ucfirst($blotters->respondent->lastName)}}">
                    </div>

                    <div class="form-group">
                        <label for="Respondent Name">Complainant Name</label>
                    <input type="text" disabled class=" form-control" value="{{ Str::ucfirst($blotters->complainant->firstName) . "  ". Str::ucfirst($blotters->complainant->middleName) . "  " . Str::ucfirst($blotters->complainant->lastName)}}">
                    </div>

                    <div class="form-group">
                        <label for="Respondent Name">Description</label>
                    <textarea name="" class="form-control">{{ $blotters->description }}</textarea>
                    </div>
                </div>
            </div>
           </div>
           <div class="col-md-2">
            <button id="generateReport" class="btn btn-primary btn-outline">Generate Report</button>
           </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <!-- Include pdfmake from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
            $(".alert").show("slow").delay(3000).hide("slow");
            var person = @json($blotters);

            // csrf
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            // Indigency Certifcate
            async function generatePDFReport() {
                
                    var blotters = @json($blotters);
                    console.log(blotters);
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
                    let fSize = '15';

                    // Indigency Certificate
                    var documentDefinition = {
                        background: {
                            image: await getBase64ImageFromURL("{{ asset('images/file-action.png') }}"),
                            width: 595, // Width of the background image (A4 page width)
                            height: 842 // Height of the background image (A4 page height)
                        },

                        content: [
                            {
                                text: `${ blotters.complainant.firstName } ${ blotters.complainant.middleName.substr(0,1) }.  ${ blotters.complainant.lastName}`,
                                style: 'complainant'
                            },
                            {
                                text: `${ blotters.complainant.address }`,
                                style: 'comAddress'
                            },
                            {
                                text: `${ blotters.respondent.firstName } ${ blotters.respondent.middleName.substr(0,1) }. ${ blotters.respondent.lastName}`,
                                style: 'respondent'
                            },
                            {
                                text: `${ blotters.respondent.address }`,
                                style: 'resAddress'
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
                                text: `${secretary.firstName} ${secretary.middleName.substr(0,1)}. ${secretary.lastName}`,
                                style: 'secretary',
                                color: pColor,
                            },
                            {
                                text: `${captain.firstName} ${secretary.middleName.substr(0,1)}. ${captain.lastName}`,
                                style: 'captain',
                                color: pColor,
                            },
                        ],

                        styles: {
                            complainant: {
                                position: 'absolute',
                                fontSize: fSize,
                                color: pColor,
                                margin: [50, 150, 0, 0]
                            },
                            comAddress: {
                                position: 'absolute',
                                fontSize: 14,
                                color: pColor,
                                margin: [30, 5, 0, 0]
                            },
                            respondent: {
                                position: 'absolute',
                                fontSize: fSize,
                                color: pColor,
                                margin: [50, 60, 0, 0]
                            },
                            resAddress: {
                                position: 'absolute',
                                fontSize: 14,
                                color: pColor,
                                margin: [30, 4, 0, 0]
                            },
                            
                            days: {
                                position: 'absolute',
                                fontSize: fSize,
                                color: pColor,
                                margin: [140, 285, 0, 0]
                            },
                            month: {
                                position: 'absolute',
                                fontSize: fSize,
                                color: pColor,
                                margin: [235, -19, 0, 0]
                            },
                            year: {
                                position: 'absolute',
                                fontSize: fSize,
                                color: pColor,
                                margin: [340, -15, 0, 0]
                            },
                            secretary: {
                                position: 'absolute',
                                fontSize: 15,
                                margin: [335, 26, 0, 0]
                            },
                            captain: {
                                position: 'absolute',
                                fontSize: 15,
                                margin: [70, 60, 0, 0]
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
             $(`#generateReport`).click(function(e) {
                        e.preventDefault();
                        if (confirm("Are you sure you want to generate a blotter report?")) {
                                // Code to delete the item goes here
                                console.log("Item deleted!");
                                PostLogs(`${person.respondent_id}`, "Blotter Report");
                                generatePDFReport();
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
            

        } );
    </script>
@endsection
