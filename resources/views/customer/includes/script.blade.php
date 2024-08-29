<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.showhide').click(function(){
            $('.showhide').show();
            $(this).hide();
        });
    });
    </script>
<script>
    $(".alert-dismissible").fadeTo(6000, 500).slideUp(500, function() {
        $(".alert-dismissible").slideUp(500);
    });
</script>
<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
<script>
    function updateTime() {
        var e, t = new Date,
            a = 10 > t.getMinutes() ? "0" + t.getMinutes() : t.getMinutes(),
            n = 10 > t.getSeconds() ? "0" + t.getSeconds() : t.getSeconds(),
            s = t.getHours() >= 12 ? " PM" : " AM",
            u = (e = 0 == t.getHours() ? 12 : t.getHours() > 12 ? t.getHours() - 12 : t.getHours()) + ":" + a + ":" + n;
        document.getElementsByClassName("hms")[0].innerHTML = u, document.getElementsByClassName("ampm")[0].innerHTML =
            s;
        var g = t.getDate(),
            d = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"][t.getDay()] + ", " + [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ][t.getMonth()] + " " + g;
        document.getElementsByClassName("date")[0].innerHTML = d
    }
    updateTime(), setInterval(function() {
        updateTime()
    }, 1e3);
</script>

@stack('scripts')
