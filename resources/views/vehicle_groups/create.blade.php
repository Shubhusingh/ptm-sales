@extends('layouts.app')
@section("breadcrumb")
<li class="breadcrumb-item"><a href="#">Tyre Service </a></li>
<li class="breadcrumb-item active">Tyre Service Add</li>
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tyre Service</h3>
            </div>

            <div class="card-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!! Form::open(['route' => 'vehicle_group.store','files'=>true,'method'=>'post']) !!}
                {!! Form::hidden('user_id',Auth::user()->id)!!}

                <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('name',__('Vehicle No'), ['class' => 'form-label']) !!} 
           
        <input required="required" name="searchno" type="text" class="form-control">
                       
                    </div>
                   
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name',__('Enter Tyre Serial No'), ['class' => 'form-label']) !!}
                           <input required="required" name="serialno" type="text" class="form-control">
                        </div>
                       
                    </div>
                    
                     <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('name',__('Date'), ['class' => 'form-label']) !!}
                           <input required="required" name="date" type="date" class="form-control" placeholder="dd/mm/yyyy">
                           
                        </div>
                       
                    </div>
                     <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('name',__('Upload Image 1'), ['class' => 'form-label']) !!}
                           <input required="required" name="image" type="file" class="form-control">
                        </div>
                       
                    </div>
                     <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('name',__('Upload Image 2'), ['class' => 'form-label']) !!}
                           <input  name="image2" type="file" class="form-control" >
                        </div>
                       
                    </div>
                     <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('name',__('Upload Image 3'), ['class' => 'form-label']) !!}
                           <input  name="image3" type="file" class="form-control" >
                        </div>
                       
                    </div>
                 
                      <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('name',__('Type Service'), ['class' => 'form-label']) !!}
                            <br>
                         <input type="checkbox" id="Penumatic charge" name="service[]" value="Machine charge"/>    
                 <label style="padding: 6px;">Machine charge</label>    
              <input type="checkbox" id="Java" name="service[]" value="punture repair" />    
                 <label style="padding: 5px;">punture repair</label>    
              <input type="checkbox" id="Patch work" name="service[]" value="Patch work"/>    
                 <label style="padding: 5px;">Patch work</label>  
         <input type="checkbox" id="tube purchase" name="service[]" value="tube purchase"/>    
                 <label style="padding: 5px;">tube purchase</label>
                 
                  <input type="checkbox" id="Flap purchase" name="service[]" value="Flap purchase"/>    
                 <label style="padding: 5px;">Flap purchase</label>
                 
                  <input type="checkbox" id="tube & flap" name="service[]" value="tube & flap"/>    
                 <label style="padding: 5px;">tube & flap</label>
                  <input type="checkbox" id="valvesheet repair" name="service[]" value="valvesheet repair"/>    
                 <label style="padding: 5px;">valvesheet repair</label>
                  <input type="checkbox" id="Redial patch" name="service[]" value="Redial patch"/>    
                 <label style="padding: 5px;">Redial patch</label>
                  <input type="checkbox" id="Nylon patch" name="service[]" value="Nylon patch"/>    
                 <label style="padding: 5px;">Nylon patch</label>
                  <input type="checkbox" id="valve pin" name="service[]" value="valve pin"/>    
                 <label style="padding: 5px;">valve pin</label>
                 <input type="checkbox" id="Geator" name="service[]" value="Geator"/>    
                 <label style="padding: 5px;">Geator</label>
                  <input type="checkbox" id="Air top up" name="service[]" value="Air top up"/>    
                 <label style="padding: 5px;">Air top up</label>
                  <input type="checkbox" id="Tyre rotation" name="service[]" value="Tyre rotation"/>    
                 <label style="padding: 5px;">Tyre rotation</label>
                  <input type="checkbox" id="Air filter clining" name="service[]" value="wheel bold opening fittig"/>    
                 <label style="padding: 5px;">wheel bold opening fittig</label>
               
                    <input type="checkbox" id="Jack charge" name="service[]" value="Jack charge"/>    
                 <label style="padding: 5px;">Jack charge</label>
                  <input type="checkbox" id="laber charge" name="service[]" value="laber charge"/>    
                 <label style="padding: 5px;">laber charge</label>
                 
                  <input type="checkbox" id="Air top up" name="service[]" value="Solution"/>    
                 <label style="padding: 5px;">Solution</label>
                  <input type="checkbox" id="Tyre rotation" name="service[]" value="valve pin"/>    
                 <label style="padding: 5px;">valve pin</label>
                  <input type="checkbox" id="valve die" name="service[]" value="valve die"/>    
                 <label style="padding: 5px;">valve die</label>
                   <input type="checkbox" id="patch no 3" name="service[]" value="patch no 3"/>    
                 <label style="padding: 5px;">patch no 3</label>
               
                    <input type="checkbox" id="patch no 4" name="service[]" value="patch no 4"/>    
                 <label style="padding: 5px;">patch no 4</label>
                  <input type="checkbox" id="patch no 5" name="service[]" value="patch no 5"/>    
                 <label style="padding: 5px;">patch no 5</label>
                 
                 
                  
                    <input type="checkbox" id="patch no 6" name="service[]" value="patch no 6"/>    
                 <label style="padding: 5px;">patch no 6</label>
                  <input type="checkbox" id="patch no 7" name="service[]" value="patch no 7"/>    
                 <label style="padding: 5px;">patch no 7</label>
                 
                 
                                     <input type="checkbox" id="patch no 10" name="service[]" value="patch no 10"/>    
                 <label style="padding: 5px;">patch no 10</label>
                  <input type="checkbox" id="patch no 12" name="service[]" value="patch no 12"/>    
                 <label style="padding: 5px;">patch no 12</label>
                 
                 
                  
                    <input type="checkbox" id="patch no 13" name="service[]" value="patch no 13"/>    
                 <label style="padding: 5px;">patch no 13</label>
                  <input type="checkbox" id="patch no 14" name="service[]" value="patch no 14"/>    
                 <label style="padding: 5px;">patch no 14</label>
                 
                 
                 
                    <input type="checkbox" id="patch no 15" name="service[]" value="patch no 15"/>    
                 <label style="padding: 5px;">patch no 15</label>
                  <input type="checkbox" id="patch no 16" name="service[]" value="patch no 16"/>    
                 <label style="padding: 5px;">patch no 16</label>
                 
                 
                    <input type="checkbox" id="patch no 20" name="service[]" value="patch no 20"/>    
                 <label style="padding: 5px;">patch no 20</label>
                  <input type="checkbox" id="patch no 30" name="service[]" value="patch no 30"/>    
                 <label style="padding: 5px;">patch no 30</label>
                 
                 
                      <input type="checkbox" id="patch no 32" name="service[]" value="patch no 32"/>    
                 <label style="padding: 5px;">patch no 32</label>
                  <input type="checkbox" id="patch no 33" name="service[]" value="patch no 33"/>    
                 <label style="padding: 5px;">patch no 33</label>
                 
                 
                 
                   <input type="checkbox" id="patch no 35" name="service[]" value="patch no 35"/>    
                 <label style="padding: 5px;">patch no 35</label>
                  <input type="checkbox" id="patch no 37" name="service[]" value="patch no 37"/>    
                 <label style="padding: 5px;">patch no 37</label>
                 
                 
                   <input type="checkbox" id="patch no 38" name="service[]" value="patch no 38"/>    
                 <label style="padding: 5px;">patch no 38</label>
                  <input type="checkbox" id="patch no 40" name="service[]" value="patch no 40"/>    
                 <label style="padding: 5px;">patch no 40</label>
                 
                 
                      <input type="checkbox" id="patch no 42" name="service[]" value="patch no 42"/>    
                 <label style="padding: 5px;">patch no 42</label>
                  <input type="checkbox" id="patch no 44" name="service[]" value="patch no 44"/>    
                 <label style="padding: 5px;">patch no 44</label>
                 
                 
                 
                      <input type="checkbox" id="patch no 45" name="service[]" value="patch no 45"/>    
                 <label style="padding: 5px;">patch no 45</label>
                  <input type="checkbox" id="patch no 46" name="service[]" value="patch no 46"/>    
                 <label style="padding: 5px;">patch no 46</label>
                 
                 
                     <input type="checkbox" id="patch no 48" name="service[]" value="patch no 48"/>    
                 <label style="padding: 5px;">patch no 48</label>
                  <input type="checkbox" id="patch no 50" name="service[]" value="patch no 50"/>    
                 <label style="padding: 5px;">patch no 50</label>
                 
                 
                     <input type="checkbox" id="patch no 52" name="service[]" value="patch no 53"/>    
                 <label style="padding: 5px;">patch no 52</label>
                  <input type="checkbox" id="patch no 55" name="service[]" value="patch no 55"/>    
                 <label style="padding: 5px;">patch no 55</label>
                 
                  <input type="checkbox" id="patch no 84" name="service[]" value="patch no 84"/>    
                 <label style="padding: 5px;">patch no 84</label>
                 
                        <input type="checkbox" id="Patch No 86" name="service[]" value="Patch No 86"/>    
                 <label style="padding: 5px;">Patch No 86</label>
                 
                 
                 
                 
                 
                 
                     <input type="checkbox" id="Tyre fitment charge" name="service[]" value="Tyre fitment charge"/>    
                 <label style="padding: 5px;">Tyre fitment charge</label>
                  <input type="checkbox" id="Tyre Section repair" name="service[]" value="Tyre Section repair"/>    
                 <label style="padding: 5px;">Tyre Section repair</label>
                 
           
                 
                 
                    <input type="checkbox" id="Old Tyre Perchase" name="service[]" value="Old Tyre Perchase"/>    
                 <label style="padding: 5px;">Old Tyre Perchase</label>
                  <input type="checkbox" id="Tube Value Body" name="service[]" value="Tube Value Body"/>    
                 <label style="padding: 5px;">Tube Value Body</label>
                 
                 
                   <input type="checkbox" id="TL-tyre fitement" name="service[]" value="TL-tyre fitement"/>    
                 <label style="padding: 5px;">TL-tyre fitement</label>
                  <input type="checkbox" id="TL-type repair" name="service[]" value="TL-type repair"/>    
                 <label style="padding: 5px;">TL-type repair</label>
                 
             
             
             
         
              
                 
                 
                 
                        </div>
                  
                       
                    </div>
                    
                      
                </div>
                 <div class="row">
                 <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('name',__('Remarks'), ['class' => 'form-label']) !!}
                         <textarea class="form-control" name="review" rows="2" cols="40"></textarea>
                        </div>
                       
                    </div>
                    </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::submit(__('Save'), ['class' => 'btn btn-info']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const label = this.nextElementSibling; // Get the label associated with the checkbox
                if (this.checked) {
                    label.classList.add('highlight'); // Add the 'highlight' class when checked
                } else {
                    label.classList.remove('highlight'); // Remove the 'highlight' class when unchecked
                }
            });
        });
    });
</script>

<!-- CSS -->
<style>
    .highlight {
        color: green; /* Change the color as per your requirement */
    }
</style>

@endsection