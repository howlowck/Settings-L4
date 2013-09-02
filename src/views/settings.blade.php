<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    @section ('assets')
        @if(Setting::getFormType($name) == 'textarea')
            <script src="{{asset('packages/howlowck/settings-l4/assets/ckeditor/ckeditor.js')}}"></script>
        @endif
    @show
</head>
<body>
    <div class="settings-container">
        @section ('settings-title')
            <h2>{{Setting::getTitle($name)}}</h2>
        @show

        @section ('settings-form')
            {{Form::open(array('url' => Setting::getUpdateUrl($name), 'method' => 'put'))}}
            {{Setting::getField($name)}}
            <input type="submit" value="Save">
            {{Form::close()}}
        @show
    </div>
    @section ('script')
        <script>
            @if(Setting::getFormType($name) == 'textarea')
                CKEDITOR.replace('{{$name}}');
            @endif
        </script>
    @show
</body>
</html>