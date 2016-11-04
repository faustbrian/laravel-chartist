<script>
$(function() {
    new Chartist.{{ $type }}('#{{ $prefix }}{{ $element }}', {
        @if(!empty($labels))
        labels: {!! json_encode($labels) !!},
        @endif
        series: {!! json_encode($series) !!}
    }, {!! json_encode($options) !!}, {!! json_encode($responsiveOptions) !!});
});
</script>
