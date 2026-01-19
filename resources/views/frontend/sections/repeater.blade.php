@php
    $lang = app()->getLocale();
@endphp

<section class="py-24 bg-gray-50">
    <div class="container mx-auto px-4">

        <div class="grid md:grid-cols-3 gap-8">

            @foreach($data->items as $item)
                <div class="bg-white rounded-2xl p-8 card-hover fade-in">

                    <h4 class="text-xl font-bold mb-3 gradient-text">
                        {{ $item['title'][$lang] ?? '' }}
                    </h4>

                    <p class="text-gray-600 leading-relaxed">
                        {{ $item['desc'][$lang] ?? '' }}
                    </p>

                </div>
            @endforeach

        </div>

    </div>
</section>
