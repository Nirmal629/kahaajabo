	<!-- Bootstrap JS -->
	<script src="{{ asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{ asset('public/assets/js/jquery.min.js')}}"></script>
	<script src="{{ asset('public/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{ asset('public/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{ asset('public/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{ asset('public/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{ asset('public/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<script src="{{ asset('public/assets/plugins/chartjs/js/chart.js')}}"></script>
	<script src="{{ asset('public/assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
	<script src="{{ asset('public/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
	<script src="{{ asset('public/assets/plugins/jquery-knob/excanvas.js')}}"></script>
	<script src="{{ asset('public/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
	<script src="{{ asset('public/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{ asset('public/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    

	<script>
		  $(function() {
			  $(".knob").knob();
		  });
	</script>
	<script src="{{ asset('public/assets/js/index.js')}}"></script>
	<!--app JS-->
	<script src="{{ asset('public/assets/js/app.js')}}"></script>
    
	<script>
		new PerfectScrollbar(".app-container")
	</script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
        $(document).ready(function() {
			var table = $('#example3').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
	<script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
	<script>
(function () {

    function applyStatusStyle(span) {
        if (!span) return;

        const text = span.textContent.trim().toLowerCase();

        span.classList.add('status-badge');
        span.classList.remove('status-active', 'status-inactive');

        if (text === 'active') {
            span.classList.add('status-active');
        } else if (text === 'inactive') {
            span.classList.add('status-inactive');
        }
    }

    function initStatusBadges() {
        document.querySelectorAll('span[id^="status-text-"]').forEach(applyStatusStyle);
    }

    // 1️⃣ Apply on initial page load
    document.addEventListener('DOMContentLoaded', initStatusBadges);

    // 2️⃣ Watch for ANY future text change (AJAX, checkbox, etc.)
    const observer = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
            let target = mutation.target;

            if (target.nodeType === 3) {
                target = target.parentElement;
            }

            if (target && target.id && target.id.startsWith('status-text-')) {
                applyStatusStyle(target);
            }
        });
    });

    // 3️⃣ Observe the whole document (important)
    document.addEventListener('DOMContentLoaded', () => {
        observer.observe(document.body, {
            subtree: true,
            characterData: true,
            childList: true
        });
    });

})();

function formatDate(date) {
    if (!date) return '-';

    const d = new Date(date);

    if (isNaN(d.getTime())) return '-';

    const day = String(d.getDate()).padStart(2, '0');
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const year = d.getFullYear();

    return `${day}-${month}-${year}`;
}
</script>


