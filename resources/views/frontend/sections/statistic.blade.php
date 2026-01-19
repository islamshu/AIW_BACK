<section class="py-16 bg-[#112240]">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach (App\Models\HomeStat::orderby('order')->get() as $sta )
                    
                <div class="text-center fade-in">
                    <div class="text-3xl md:text-4xl font-bold gradient-text mb-2">{{$sta->value}}</div>
                    <div class="text-[#a8b2d1]" > {{$sta->label}} </div>
                </div>
                @endforeach

           
            </div>
        </div>
    </section>