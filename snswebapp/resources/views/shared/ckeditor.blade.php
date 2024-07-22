<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
editor = CKEDITOR.replace('{{$id ?? "editor"}}', {
    contentsCss: '/css/editor.css',
    uiColor: '#eeeeee',
    height: {{$height ?? 400}},
    disableNativeSpellChecker: true,
    removeButtons: 'Save,NewPage,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,CreateDiv,BidiLtr,BidiRtl,Language,Flash,Iframe',
    colorButton_backStyle: {
        element: 'span',
        styles: {'background-color': '#(color)'}
    },
    colorButton_colors: '00f,f00,080',
});

editor.name = '{{$name ?? "body"}}';
</script>