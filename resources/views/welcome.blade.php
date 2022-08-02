<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Care Quality Commission - API Explorer</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"/>
        <script src="https://kit.fontawesome.com/69ebd03f48.js" crossorigin="anonymous"></script>
    </head>
    <body class="h-full">
        <div class="flex flex-col px-9 lg:px-96 py-10 bg-gray-900 h-1/3">
            <div class="flex items-center">
                <i class="fa fa-archive text-3xl text-white mr-4"></i>
                <h2 class="text-gray-200 font-semibold"><strong>Care Quality Commission</strong> API Explorer</h2>
            </div>
            <div class="flex flex-grow items-center justify-center">
                <div class="flex flex-col w-full lg:w-1/2">
                    <div class="relative">
                        <input type="search" class="w-full text-gray-200 outline-none bg-gray-800 border-none rounded-md shadow-md border border-b-2 border-gray-700 px-4 py-4 focus:translate-y-1" placeholder="Search stored providers...">
                        <div class="absolute rounded-md w-full mt-3 flex-col hidden" ref="dropdown"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-blue-900 px-9 lg:px-96 py-10 h-2/3 overflow-y-auto">
            <div class="flex flex-col py-10">
                <div class="flex items-center justify-between">
                    <h2 class="text-3xl font-semibold text-white underline">Explore CQC API</h2>
                    <i class="prev-page text-gray-300 hover:text-white transition ease duration-200 cursor-pointer text-2xl fa fa-chevron-left"></i>            
                    <i class="next-page text-gray-300 hover:text-white transition ease duration-200 cursor-pointer text-2xl fa fa-chevron-right"></i>            
                </div>
            </div>
            <div class="lg:columns-2 lg:gap-10 md:columns-2 md:gap-10" ref="API_Providers"></div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/API/CQC/exploreProviders.js') }}"></script>

        <script type="text/javascript">
            // When the user searches for a provider, show the results in the dropdown
            $(document).ready(function() {
                let searchTimeout;
                let exploreProviders = new ExploreProviders('div[ref="API_Providers"]');
                let providers = $('div[ref="API_Providers"]');
                let existingProviders = [];

                exploreProviders.getPage().then(response => {
                    // render the providers inside providers ref element
                    providers.html(exploreProviders.renderProviders(response.data.providers));
                })
                $('input[type="search"]').on('keyup', function() {
                    let search = $('input[type="search"]').val();
                    let dropdown = $('[ref="dropdown"]');

                    if(search.trim() == ''){
                        dropdown.hide();
                        return;
                    }

                    // Clear the timeout if it's already set.
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(function() {

                        if (search.length > 3) {
                            axios.get('/api/providers/search/' + search).then(function(response) {
                                dropdown.addClass('flex').hide().fadeIn("fast");
                                dropdown.html('');
                                if(response.data.length == 0){

                                } else {
                                    response.data.forEach(function(provider) {
                                        dropdown.append('<a target="_blank" href="/api/providers/' + provider.uuid + '" class="first:rounded-t-md last:rounded-b-md last:border-b-0"><div class="flex bg-gray-100 hover:bg-white transition ease duration-200 text-gray-600 hover:text-black items-center px-4 py-2 border-b-2 border-gray-200 hover:border-gray-100"><i class="fa fa-archive text-3xl mr-4"></i><div class="flex flex-col"><h2 class="font-bold text-sm">' + provider.name + '</h2><p class="mt-1 text-sm">' + provider.info.postalAddressTownCity + '</p></div></div></a>');
                                    });
                                }
                            });
                        } else {
                            $('.absolute').html('');
                        }
                    }, 500);
                });

                $('input[type="search"]').on('blur', function() {
                    setTimeout(function() {
                        $('input[type="search"]').val('');
                        if (!$('[ref="dropdown"]').is(':hover')) {
                            $('[ref="dropdown"]').hide();
                        }
                    }, 100);
                });
                $('body').on('click', '.store-provider:not(.bg-red-900)', function(){
                    exploreProviders.storeLocally($(this).attr('provider-id'));
                    $(this).addClass('bg-red-900').removeClass('bg-green-500 bg-green-700').removeClass('hover:bg-green-600 hover:bg-green-800');
                    $(this).text('Stored.');
                });

                $('.next-page').on('click', function(){
                    exploreProviders.pageNext();
                });

                $('.prev-page').on('click', function(){
                    exploreProviders.pagePrev();
                });
            });
        </script>
    </body>
</html>
