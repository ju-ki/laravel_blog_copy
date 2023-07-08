<?php
/** @var $posts \Illuminate\Pagination\LengthAwarePaginator */
?>

<x-app-layout meta-description="Jukiyaのブログ">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Latest Post --}}
            <div class="col-span-2">
                <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercapse pb-1 border-b-2 border-blue-500 mb-3">
                    Latest Post
                </h2>
                <x-post-item :post="$latestPost" />
            </div>
            {{-- Popular 3 post --}}
            <div>
                <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercapse pb-1 border-b-2 border-blue-500 mb-3">
                    Popular Post
                </h2>
                @foreach ($popularPosts as $post)
                    <div class="grid grid-cols-4 gap-2 mb-3">
                        <a href="{{ route('view', $post) }}" class="pt-2">
                            <img src="{{ $post->getThumbnail() }}" alt="{{ $post->title }}">
                        </a>
                        <div class="col-span-3">
                            <a href="{{ route('view', $post) }}">
                                <h3 class="text-sm uppercase white-nowrap truncate">
                                    {{ $post->title }}
                                </h3>
                            </a>
                            <div class="flex gap-4 mb-2">
                                @foreach ($post->categories as $category)
                                    <a href="#"
                                        class="bg-blue-500 text-white rounded  text-xs font-bold uppercase pb-4">
                                        {{ $category->title }}
                                    </a>
                                @endforeach
                            </div>
                            <div class="text-sm">
                                {{ $post->shortBody(10) }}
                            </div>
                            <a href="{{ route('view', $post) }}"
                                class="text-xs uppercase text-gray-800 hover:text-black">Continue Reading <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach
                {{-- <x-post-item :post="$popularPost" /> --}}
            </div>
        </div>

        {{-- Recommended Post --}}
        <div class="mb-4">
            <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercapse pb-1 border-b-2 border-blue-500 mb-3">
                Recommended Posts
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                @foreach ($recommendedPosts as $post)
                    <x-post-item :post="$post" :show-author="false"></x-post-item>
                @endforeach
            </div>
        </div>
        {{-- Latest Category --}}
        <div>
            <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercapse pb-1 border-b-2 border-blue-500 mb-3">
                Recent Category
            </h2>
            {{-- {{ $categories }} --}}
            @foreach ($categories as $category)
                <div class="mb-6">
                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">
                        {{ $category->title }}
                    </a>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        @foreach ($category->publishedPosts()->limit(3)->get() as $post)
                            <x-post-item :post="$post" :show-author="false" />
                        @endforeach
                    </div>
                </div>
                {{-- <x-post-item :post="$post" :show-author="false"></x-post-item> --}}
            @endforeach
        </div>
    </div>
    {{-- <section class="w-full md:w-2/3 flex flex-col items-center px-3">
        @foreach ($posts as $post)
            <x-post-item :post="$post"></x-post-item>
        @endforeach

        {{ $posts->onEachSide(1)->links() }}

    </section>

    <x-sidebar></x-sidebar> --}}

</x-app-layout>
