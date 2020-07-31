@extends('layouts.front')
@section('heading',"Create Thread")
@section('content')


    <div class="row">
        <div class=" well">
            <form class="form-vertical" action="{{route('thread.store')}}" method="post" role="form"
                  id="create-thread-form">
                @csrf
                <div class="jumbotron">
                    <div class="form-group d-inline-block">
                       <h1><label for="subject">Subject</label></h1>
                        <input type="text" class="form-control" name="subject" id="" placeholder="Input..."
                               value="{{old('subject')}}">
                    </div>
                </div>
                <div class="jumbotron">
                    <div class="form-group">
                        <h1><label for="type">Type</label></h1>
                        <input type="text" class="form-control" name="type" id="" placeholder="Input..."
                               value="{{old('type')}}">
                    </div>
                </div>



               <div class="jumbotron">
                   <div class="form-group">
                      <h1> <label for="thread">Thread</label></h1>
                       <textarea class="form-control" name="thread" row="300" cols="500" id="" placeholder="Input..."
                       > {{old('thread')}}</textarea>
                   </div>
               </div>
                <div class = "jumbotron">
                    <h1>Please select below options !</h1>
                    <div class = "form-group">
                        {!! app('captcha')->display()!!}
                        {!! NoCaptcha::renderJs() !!}
                    </div>

                </div>



                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>



@endsection
