<script src="https://cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script>
<script>
editor = CKEDITOR.replace('editor', {
    contentsCss: '/css/editor.css',
    uiColor: '#eeeeee',
    height: 400,
    disableNativeSpellChecker: true,
    removeButtons: 'Save,NewPage,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,CreateDiv,BidiLtr,BidiRtl,Language,Flash,Iframe',
    colorButton_backStyle: {
        element: 'span',
        styles: {'background-color': '#(color)'}
    },
    colorButton_colors: '00f,f00,080',
});

editor.name = '{{$name}}';
</script>