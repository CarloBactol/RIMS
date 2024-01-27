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
                    role="tab">Business Permit</a>
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
                        <p style="text-align: center;"><strong>Republic of the Philippines</strong></p>
                        <p style="text-align: center;">Lingayen Pangasinan Municipality</p>
                        <p style="text-align: center;">Barangay Quibaol</p>
                        <p style="text-align: center;"><strong>OFFICE OF THE PUNONG BARANGAY</strong></p>
                        <br>
                        <p style="text-align: center;"><strong>BARANGAY CLEARANCE</strong></p>
                        <br>
                        @php
                        $now = now();
                        $dateBirth = Carbon\Carbon::parse($resident->dateOfBirth);
                        $expiryDate = $now->clone()->addWeeks(2);
                        $age = $dateBirth->age;
                        @endphp
                        <p>TO WHOM IT MAY CONCERN:</p>
                        <p>This is to certify that Mr./Ms.
                            {{ Str::ucfirst($resident->firstName) . ' ' . Str::ucfirst($resident->lastName) }},
                            {{ $age }} years old, {{ Str::ucfirst($resident->civilStatus) }},
                            {{ Str::ucfirst($resident->nationality) }}, and a resident of {{ $resident->address }},
                            Barangay {{ $resident->barangay }}, Lingayen Pangasinan Municipality, has been cleared of
                            any derogatory records and is hereby granted this Barangay Clearance.</p>
                        <p>This certification is being issued upon the request of the above-named individual for
                            {{ Str::lower($resident->purpose) }}.</p>
                        <p>This Barangay Clearance is valid until {{ $expiryDate->toDateString() }}.</p>
                        <p>Issued this on {{ $now->format('F j, Y') }}, at Barangay {{ $resident->barangay }}.</p>
                        <br>

                        <div style="text-align: center;">
                            <div style="display: inline-block; text-align: left;">
                                <p>_____________________<br><strong>{{ $captain->role === 'Captain' ?
                                        Str::ucfirst($captain->firstName) . ' ' . Str::ucfirst($captain->lastName) : ''
                                        }}</strong><br>Punong
                                    Barangay</p>
                            </div>
                            <div style="display: inline-block; text-align: left; margin-left: 50px;">
                                <p>_____________________<br><strong>{{ $secretary->role === 'Councilors' &&
                                        $secretary->isSecretary ? Str::ucfirst($secretary->firstName) . ' ' .
                                        Str::ucfirst($secretary->lastName) : '' }}</strong><br>Barangay
                                    Secretary</p>
                            </div>
                        </div>
                        <br>
                        <button id="bcPDF" class="btn btn-primary btn-outline">Generate PDF</button>
                    </div>

                </div>

                {{-- certicate of residency --}}
                <div class="tab-pane" id="residency" role="tabpanel">
                    <div class="container-fluid">
                        <p style="text-align: center;"><strong>Republic of the Philippines</strong></p>
                        <p style="text-align: center;">Lingayen Pangasinan Municipality</p>
                        <p style="text-align: center;">Barangay Quibaol</p>
                        <p style="text-align: center;"><strong>OFFICE OF THE PUNONG BARANGAY</strong></p>
                        <br>
                        <p style="text-align: center;"><strong>CERTIFICATE OF RESIDENCY</strong></p>
                        <br>
                        @php
                        $now = now();
                        $residentAge = now()->diffInYears(Carbon\Carbon::parse($resident->dateOfBirth));
                        $expiryDate = $now->addWeeks(2);
                        @endphp
                        <p>TO WHOM IT MAY CONCERN:</p>
                        <p>This is to certify that Mr./Ms.
                            {{ Str::ucfirst($resident->firstName) . ' ' . Str::ucfirst($resident->lastName) }},
                            {{ $residentAge }} years old, {{ Str::ucfirst($resident->civilStatus) }},
                            {{ Str::ucfirst($resident->nationality) }}, and a resident of {{ $resident->address }},
                            Barangay {{ $resident->barangay }}, Lingayen Pangasinan Municipality, is a bona fide
                            resident of this Barangay.</p>
                        <p>This certification is being issued upon the request of the above-named individual for
                            {{ Str::lower($resident->purpose) }}.</p>
                        <p>This Certificate of Residency is valid until {{ $expiryDate->toDateString() }}.</p>
                        <p>Issued this on {{ $now->format('F j, Y') }}, at Barangay {{ $resident->barangay }}.</p>
                        <br>

                        <div style="text-align: center;">
                            <div style="display: inline-block; text-align: left;">
                                <p>_____________________<br><strong>{{ $captain->role === 'Captain' ?
                                        Str::ucfirst($captain->firstName) . ' ' . Str::ucfirst($captain->lastName) : ''
                                        }}</strong><br>Punong
                                    Barangay</p>
                            </div>
                            <div style="display: inline-block; text-align: left; margin-left: 50px;">
                                <p>_____________________<br><strong>{{ $secretary->role === 'Councilors' &&
                                        $secretary->isSecretary ? Str::ucfirst($secretary->firstName) . ' ' .
                                        Str::ucfirst($secretary->lastName) : '' }}</strong><br>Barangay
                                    Secretary</p>
                            </div>
                        </div>
                        <br>
                        <button id="crPDF" class="btn btn-primary btn-outline">Generate PDF</button>
                    </div>
                </div>

                {{-- business permit --}}
                <div class="tab-pane" id="business" role="tabpanel">
                    <div class="container-fluid">
                        <p style="text-align: center;"><strong>Republic of the Philippines</strong></p>
                        <p style="text-align: center;">Lingayen Pangasinan Municipality</p>
                        <p style="text-align: center;">Barangay Quibaol</p>
                        <p style="text-align: center;"><strong>OFFICE OF THE PUNONG BARANGAY</strong></p>
                        <br>
                        <p style="text-align: center;"><strong>BUSINESS PERMIT</strong></p>
                        <br>
                        @php
                        $now = now();
                        $businessInfo = $resident->business;
                        $expiryDateBusiness = $now->clone()->addYear(1);

                        @endphp
                        <p>TO WHOM IT MAY CONCERN:</p>
                        <p>This is to certify that {{ $businessInfo->businessName }}, owned and operated by {{
                            Str::ucfirst($resident->firstName) . ' '. Str::ucfirst($resident->lastName) }}, with
                            business address at {{ $businessInfo->businessAddress }}, Barangay {{ $resident->barangay
                            }}, Lingayen Pangasinan Municipality, has been granted this Business Permit.</p>
                        <p>This permit is valid until {{ $expiryDateBusiness->toDateString() }}.</p>
                        <p>Issued this on {{ $now->format('F j, Y') }}, at Barangay {{ $resident->barangay }}.</p>
                        <br>
                        <div style="text-align: center;">
                            <div style="display: inline-block; text-align: left;">
                                <p>_____________________<br><strong>{{ $captain->role === 'Captain' ?
                                        Str::ucfirst($captain->firstName) . ' ' . Str::ucfirst($captain->lastName) : ''
                                        }}</strong><br>Punong Barangay</p>
                            </div>
                            <div style="display: inline-block; text-align: left; margin-left: 50px;">
                                <p>_____________________<br><strong>{{ $treasurer->role === 'Councilors' &&
                                        $treasurer->isTreasurer ? Str::ucfirst($treasurer->firstName) . ' ' .
                                        Str::ucfirst($treasurer->lastName) : '' }}</strong><br>Barangay Treasurer</p>
                            </div>
                        </div>
                        <br>
                        <button id="businessPermitPDF" class="btn btn-primary btn-outline">Generate PDF</button>
                    </div>


                </div>

                {{-- indigency certificate --}}
                <div class="tab-pane" id="indigency" role="tabpanel">
                    <div class="container-fluid">
                        <p style="text-align: center;"><strong>Republic of the Philippines</strong></p>
                        <p style="text-align: center;">Lingayen Pangasinan Municipality</p>
                        <p style="text-align: center;">Barangay Quibaol</p>
                        <p style="text-align: center;"><strong>OFFICE OF THE PUNONG BARANGAY</strong></p>
                        <br>
                        <p style="text-align: center;"><strong>INDIGENCY CERTIFICATE</strong></p>
                        <br>
                        @php
                        $now = now();
                        $expiryDate = $now->clone()->addWeeks(2);
                        $dateBirth = Carbon\Carbon::parse($resident->dateOfBirth);
                        $age = $dateBirth->age;
                        @endphp
                        <p>TO WHOM IT MAY CONCERN:</p>
                        <p>This is to certify that Mr./Ms.
                            {{ Str::ucfirst($resident->firstName) . ' ' . Str::ucfirst($resident->lastName) }},
                            {{ $age }} years old, {{ Str::ucfirst($resident->civilStatus) }},
                            {{ Str::ucfirst($resident->nationality) }}, and a resident of {{ $resident->address }},
                            Barangay {{ $resident->barangay }}, Lingayen Pangasinan Municipality, is hereby granted
                            this Indigency Certificate.</p>
                        <p>This certification is being issued upon the request of the above-named individual to attest
                            to his/her indigent status.</p>
                        <p>This Indigency Certificate is valid until {{ $expiryDate->toDateString() }}.</p>
                        <p>Issued this on {{ $now->format('F j, Y') }}, at Barangay {{ $resident->barangay }}.</p>
                        <br>

                        <div style="text-align: center;">
                            <div style="display: inline-block; text-align: left;">
                                <p>_____________________<br><strong>{{ $captain->role === 'Captain' ?
                                        Str::ucfirst($captain->firstName) . ' ' . Str::ucfirst($captain->lastName) : ''
                                        }}</strong><br>Punong
                                    Barangay</p>
                            </div>
                            <div style="display: inline-block; text-align: left; margin-left: 50px;">
                                <p>_____________________<br><strong>{{ $secretary->role === 'Councilors' &&
                                        $secretary->isSecretary ? Str::ucfirst($secretary->firstName) . ' ' .
                                        Str::ucfirst($secretary->lastName) : '' }}</strong><br>Barangay
                                    Secretary</p>
                            </div>
                        </div>
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
            function generatePDFBarangayClearance() {
                var user = @json($resident);
                var captain = @json($captain);
                var secretary = @json($secretary);

                var currentDate = new Date();
                var twoWeeksLater = new Date();
                twoWeeksLater.setDate(currentDate.getDate() + 14);

                // Formatting the result
                var formattedDate = twoWeeksLater.toLocaleDateString('en-PH', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                var dateNow = currentDate.toLocaleDateString('en-PH', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });


                // BC
                var documentDefinition = {
                    content: [{
                            text: `Republic of the Philippines\nLingayen Pangasinan Municipality\nBarangay ${user.barangay}\nOFFICE OF THE PUNONG BARANGAY`,
                            style: 'header'
                        },
                        {
                            text: 'BARANGAY CLEARANCE',
                            style: 'title'
                        },
                        {
                            text: 'TO WHOM IT MAY CONCERN:',
                            style: 'subtitle'
                        },
                        {
                            text: `This is to certify that Mr./Ms. ${user.firstName + ' ' + user.lastName}, ${user.age.toString()} years old, ${user.civilStatus}, ${user.nationality}, and a resident of ${user.address}, Barangay ${user.barangay}, Lingayen Pangasinan Municipality, has been cleared of any derogatory records and is hereby granted this Barangay Clearance.`,
                            style: 'paragraph'
                        },
                        {
                            text: `This certification is being issued upon the request of the above-named individual for ${user.purpose}.`,
                            style: 'paragraph'
                        },
                        {
                            text: `This Barangay Clearance is valid until ${formattedDate}.`,
                            style: 'paragraph'
                        },
                        {
                            text: `Issued this date on ${dateNow}, at Barangay ${user.barangay}`,
                            style: 'paragraph'
                        },
                        {
                            columns: [{
                                    text: `_____________________\n${captain.firstName+ " " + captain.lastName}\nPunong Barangay`,
                                    style: 'signature'
                                },
                                {
                                    text: `_____________________\n${secretary.firstName + " " + secretary.lastName}\nBarangay Secretary`,
                                    style: 'signature'
                                }
                            ]
                        }
                    ],
                    styles: {
                        header: {
                            fontSize: 12,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 10]
                        },
                        title: {
                            fontSize: 16,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 10]
                        },
                        subtitle: {
                            fontSize: 12,
                            bold: true,
                            margin: [0, 10, 0, 10]
                        },
                        paragraph: {
                            fontSize: 12,
                            margin: [0, 0, 0, 10]
                        },
                        signature: {
                            fontSize: 10,
                            margin: [0, 20, 0, 0]
                        }
                    }
                };

                // Generate PDF
                pdfMake.createPdf(documentDefinition).open();
            }

            // Certificate of Residency
            function generatePDFCerticateResidency() {
                var user = @json($resident);
                var captain = @json($captain);
                var secretary = @json($secretary);

                var currentDate = new Date();
                var twoWeeksLater = new Date();
                twoWeeksLater.setDate(currentDate.getDate() + 14);

                // Formatting the result
                var formattedDate = twoWeeksLater.toLocaleDateString('en-PH', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                var dateNow = currentDate.toLocaleDateString('en-PH', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });


                // CR
                var documentDefinition = {
                    content: [{
                            text: `Republic of the Philippines\nLingayen Pangasinan Municipality\nBarangay ${user.barangay}\nOFFICE OF THE PUNONG BARANGAY`,
                            style: 'header'
                        },
                        {
                            text: 'CERTIFICATE OF RESIDENCY',
                            style: 'title'
                        },
                        {
                            text: 'TO WHOM IT MAY CONCERN:',
                            style: 'subtitle'
                        },
                        {
                            text: `This is to certify that Mr./Ms. ${user.firstName + ' ' + user.lastName}, ${user.age.toString()} years old, ${user.civilStatus}, ${user.nationality}, and a resident of ${user.address}, Barangay ${user.barangay}, Lingayen Pangasinan Municipality, is a bona fide resident of this Barangay.`,
                            style: 'paragraph'
                        },
                        {
                            text: `This certification is being issued upon the request of the above-named individual for ${user.purpose}.`,
                            style: 'paragraph'
                        },
                        {
                            text: `This Certificate of Residency is valid until ${formattedDate}.`,
                            style: 'paragraph'
                        },
                        {
                            text: `Issued this date on ${dateNow}, at Barangay ${user.barangay}.`,
                            style: 'paragraph'
                        },
                        {
                            columns: [{
                                    text: `_____________________\n${captain.firstName+ " " + captain.lastName}\nPunong Barangay`,
                                    style: 'signature'
                                },
                                {
                                    text: `_____________________\n${secretary.firstName + " " + secretary.lastName}\nBarangay Secretary`,
                                    style: 'signature'
                                }
                            ]
                        }
                    ],
                    styles: {
                        header: {
                            fontSize: 12,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 10]
                        },
                        title: {
                            fontSize: 16,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 10]
                        },
                        subtitle: {
                            fontSize: 12,
                            bold: true,
                            margin: [0, 10, 0, 10]
                        },
                        paragraph: {
                            fontSize: 12,
                            margin: [0, 0, 0, 10]
                        },
                        signature: {
                            fontSize: 10,
                            margin: [0, 20, 0, 0]
                        }
                    }
                };


                // Generate PDF
                pdfMake.createPdf(documentDefinition).open();
            }

            // Business Permit
            function generatePDFBusinessPermit() {
                var user = @json($resident);
                var captain = @json($captain);
                var businessInfo = @json($resident->business);
                var mayor = @json($mayor);
                var treasurer = @json($treasurer);

                var currentDate = new Date();
                var oneYearLater = new Date();
                oneYearLater.setFullYear(currentDate.getFullYear() + 1);

                // Formatting the result
                var formattedExpiryDate = oneYearLater.toLocaleDateString('en-PH', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                var formattedDateNow = currentDate.toLocaleDateString('en-PH', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                // Business Permit
                var documentDefinition = {
                    content: [{
                            text: `Republic of the Philippines\nLingayen Pangasinan Municipality\nBarangay ${user.barangay}\nOFFICE OF THE PUNONG BARANGAY`,
                            style: 'header'
                        },
                        {
                            text: 'BUSINESS PERMIT',
                            style: 'title'
                        },
                        {
                            text: 'TO WHOM IT MAY CONCERN:',
                            style: 'subtitle'
                        },
                        {
                            text: `This is to certify that ${businessInfo.businessName}, owned and operated by ${user.firstName + ' ' + user.lastName}, with business address at ${businessInfo.businessAddress}, Barangay ${user.barangay}, Lingayen Pangasinan Municipality, has been granted this Business Permit.`,
                            style: 'paragraph'
                        },
                        {
                            text: `This permit is valid until ${formattedExpiryDate}.`,
                            style: 'paragraph'
                        },
                        {
                            text: `Issued this date on ${formattedDateNow}, at Barangay ${user.barangay}.`,
                            style: 'paragraph'
                        },
                        {
                            columns: [{
                                    text: `_____________________\n${captain.firstName + " " + captain.lastName}\nPunong Barangay`,
                                    style: 'signature'
                                },
                                {
                                    text: `_____________________\n${treasurer.firstName + " " + treasurer.lastName}\nBarangay Treasurer`,
                                    style: 'signature'
                                }
                            ]
                        }
                    ],
                    styles: {
                        header: {
                            fontSize: 12,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 10]
                        },
                        title: {
                            fontSize: 16,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 10]
                        },
                        subtitle: {
                            fontSize: 12,
                            bold: true,
                            margin: [0, 10, 0, 10]
                        },
                        paragraph: {
                            fontSize: 12,
                            margin: [0, 0, 0, 10]
                        },
                        signature: {
                            fontSize: 10,
                            margin: [0, 20, 0, 0]
                        }
                    }
                };

                // Generate PDF
                pdfMake.createPdf(documentDefinition).open();
            }


            // Indigency Certifcate
            function generatePDFIndigency() {
                var user = @json($resident);
                var captain = @json($captain);
                var secretary = @json($secretary);

                var currentDate = new Date();
                var twoWeeksLater = new Date();
                twoWeeksLater.setDate(currentDate.getDate() + 14);

                // Formatting the result
                var formattedDate = twoWeeksLater.toLocaleDateString('en-PH', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                var dateNow = currentDate.toLocaleDateString('en-PH', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                // Indigency Certificate
                var documentDefinition = {
                    content: [{
                            text: `Republic of the Philippines\nLingayen Pangasinan Municipality\nBarangay ${user.barangay}\nOFFICE OF THE PUNONG BARANGAY`,
                            style: 'header'
                        },
                        {
                            text: 'INDIGENCY CERTIFICATE',
                            style: 'title'
                        },
                        {
                            text: 'TO WHOM IT MAY CONCERN:',
                            style: 'subtitle'
                        },
                        {
                            text: `This is to certify that Mr./Ms. ${user.firstName + ' ' + user.lastName}, ${user.age.toString()} years old, ${user.civilStatus}, ${user.nationality}, and a resident of ${user.address}, Barangay ${user.barangay}, Lingayen Pangasinan Municipality, is hereby granted this Indigency Certificate.`,
                            style: 'paragraph'
                        },
                        {
                            text: `This certification is being issued upon the request of the above-named individual to attest to his/her indigent status.`,
                            style: 'paragraph'
                        },
                        {
                            text: `This Indigency Certificate is valid until ${formattedDate}.`,
                            style: 'paragraph'
                        },
                        {
                            text: `Issued this date on ${dateNow}, at Barangay ${user.barangay}.`,
                            style: 'paragraph'
                        },
                        {
                            columns: [{
                                    text: `_____________________\n${captain.firstName + " " + captain.lastName}\nPunong Barangay`,
                                    style: 'signature'
                                },
                                {
                                    text: `_____________________\n${secretary.firstName + " " + secretary.lastName}\nBarangay Secretary`,
                                    style: 'signature'
                                }
                            ]
                        }
                    ],
                    styles: {
                        header: {
                            fontSize: 12,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 10]
                        },
                        title: {
                            fontSize: 16,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 10]
                        },
                        subtitle: {
                            fontSize: 12,
                            bold: true,
                            margin: [0, 10, 0, 10]
                        },
                        paragraph: {
                            fontSize: 12,
                            margin: [0, 0, 0, 10]
                        },
                        signature: {
                            fontSize: 10,
                            margin: [0, 20, 0, 0]
                        }
                    }
                };

                // Generate PDF
                pdfMake.createPdf(documentDefinition).open();
            }



            // === Buttons Click ===

            $('#bcPDF').click(function(e) {
                e.preventDefault();
                generatePDFBarangayClearance();
            });

            $('#crPDF').click(function(e) {
                e.preventDefault();
                generatePDFCerticateResidency();
            });

            $('#businessPermitPDF').click(function(e) {
                e.preventDefault();
                generatePDFBusinessPermit();
            });

            $('#indigencyPDF').click(function(e) {
                e.preventDefault();
                generatePDFIndigency();
            });
        });
</script>
@endsection