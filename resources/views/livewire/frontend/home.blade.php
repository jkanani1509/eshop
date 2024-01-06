<div>
    <x-slot name="title">
        ESHOP || HOME
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            {{-- @livewire('frontend.functions') --}}
            @livewire('frontend.homeslider')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @livewire('frontend.homesmallbanner')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @livewire('frontend.hotitem')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @livewire('frontend.latestitem')
        </div>
    </div>
    
    

    
</div>
