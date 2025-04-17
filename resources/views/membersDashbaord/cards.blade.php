@include('includes.members.header')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 dash-headings">Cards</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="card border-left-primary shadow py-2" style="width:25rem;" id="MembershipCard">
        <div class="row">
            <div class="col-md" style="padding-left:32px">
                <img src="https://membership.c3sc.org.uk/wp-content/uploads/2023/07/c3sc-logo.png" alt="Profile Picture" height="60" class="mx-auto border" style="border-radius: 50%;" >
            </div>
            <div class="col-md d-flex justify-content-end align-items-center" style="padding-right:32px">
                <a  href="javascript:void(0);" onclick="printCardPDF()" id="printButton"><i class="fa-solid fa-print"></i></a>
                
            </div>
        </div>
        <div class="card-body licence-box">
            <h5 class="card-title"><b>{{ $organisation->organisation_name }}</b></h5>
            <p class="text-muted"><b>Member ID: </b>{{ $members->members_c3sc_id }}</p>
            <p class="text-muted"><b>Membership Status: </b>
            @if($members->user_status == 0)
                Deactivated
            @else
                Activated
            @endif
            </p>
            <p class="text-muted"><b>Member Since: </b>{{ $members->created_at->format('F d, Y') }}</p>
            <!-- <p class="text-muted"><b>Expires On: </b></p> -->

        </div>
    </div>



 </div>
<!-- /.container-fluid -->

<!-- Pdf Maker Js Code -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
function printCardPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({
        orientation: "portrait",
        unit: "mm",
        format: "a4"
    });

    // Hide print button before capturing
    document.getElementById("printButton").style.display = "none";

    // Capture card as image using html2canvas
    html2canvas(document.getElementById("MembershipCard"), { scale: 2 }).then(canvas => {
        const imgData = canvas.toDataURL("image/png");
        const imgWidth = 180;  // PDF image width
        const imgHeight = (canvas.height * imgWidth) / canvas.width; // Maintain aspect ratio

        doc.addImage(imgData, "PNG", 15, 20, imgWidth, imgHeight);
        doc.save("MembershipCard.pdf"); // Download the PDF

        // Show print button again
        document.getElementById("printButton").style.display = "block";
    });
}
</script>




@include('includes.members.footer')