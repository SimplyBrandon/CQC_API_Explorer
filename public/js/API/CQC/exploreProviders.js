class ExploreProviders
{
    constructor(el)
    {
        this.element = $(el);

        this.page = 1;
        this.nextPage = 2;
        this.prevPage = 0;

        this.providers = [];
        this.outdated = [];

        this.getExistingProviders();
    }

    getPage(pageNumber)
    {
        return axios.get('/api/providers?perPage=24&page=' + this.page);
    }

    getExistingProviders()
    {
        axios.get('/api/providers/existing').then(response => {
            response.data.forEach(provider => {
                if(new Date(provider.updated_at) > new Date(new Date().getTime() - (1000 * 60 * 60 * 24 * 7))) {
                    this.providers.push({
                        uuid: provider.uuid,
                        updated_at: provider.updated_at            
                    });
                } else {
                    this.outdated.push({
                        uuid: provider.uuid     
                    });
                }
            });
        });
    }

    storeLocally(uuid)
    {
        return axios.get('/api/providers/' + uuid).then(() => {
            this.providers.push({
                uuid: uuid,
                updated_at: new Date()            
            });

            return true;
        });
    }

    renderProviders(providers)
    {
        this.element.html('');
        providers.forEach(provider => {
            this.element.append(this.renderProvider(provider));
        });
    }

    renderProvider(provider)
    {
        if(this.providers.find(p => p.uuid == provider.providerId)) {
            return `<div class="bg-black bg-opacity-20 shadow-md rounded-md py-4 px-8 text-gray-300 mb-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex flex-col">
                        <h2 class="text-white font-semibold">` + provider.providerName + `</h2>
                    </div>
                    <div class="flex items-center justify-between lg:justify-start mt-3 lg:mt-0">
                        <a target="_blank" href="/api/providers/` + provider.providerId + `" class="flex items-center mr-4 text-xs bg-green-500 text-white hover:bg-green-600 hover:text-white transition ease duration-200 px-4 py-2 font-semibold rounded-md">
                            <i class="fa fa-eye mr-2"></i>
                            <p>View in API</p>
                        </a>
                        <button type="button" class="flex items-center text-xs text-white hover:text-white transition ease duration-200 px-4 py-2 font-semibold rounded-md store-provider bg-red-900" provider-id="` + provider.providerId + `">
                            Stored.
                        </button>
                    </div>
                </div>
            </div>`;
        } else if(this.outdated.find(p => p.uuid == provider.providerId)) {
            return `<div class="bg-black bg-opacity-20 shadow-md rounded-md py-4 px-8 text-gray-300 mb-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex flex-col">
                        <h2 class="text-white font-semibold">` + provider.providerName + `</h2>
                    </div>
                    <div class="flex items-center justify-between lg:justify-start mt-3 lg:mt-0">
                        <a target="_blank" href="/api/providers/` + provider.providerId + `" class="flex items-center mr-4 text-xs bg-green-500 text-white hover:bg-green-600 hover:text-white transition ease duration-200 px-4 py-2 font-semibold rounded-md">
                            <i class="fa fa-eye mr-2"></i>
                            <p>View in API</p>
                        </a>
                        <button type="button" class="flex items-center text-xs text-white hover:text-white transition ease duration-200 px-4 py-2 font-semibold rounded-md store-provider bg-green-700 hover:bg-green-800" provider-id="` + provider.providerId + `">
                            <i class="fa fa-save mr-2"></i>
                            Older than 7 days
                        </button>
                    </div>
                </div>
            </div>`;
        } else {
            return `<div class="bg-black bg-opacity-20 shadow-md rounded-md py-4 px-8 text-gray-300 mb-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex flex-col">
                        <h2 class="text-white font-semibold">` + provider.providerName + `</h2>
                    </div>
                    <div class="flex items-center justify-between lg:justify-start mt-3 lg:mt-0">
                        <a target="_blank" href="/api/providers/` + provider.providerId + `" class="flex items-center mr-4 text-xs bg-green-500 text-white hover:bg-green-600 hover:text-white transition ease duration-200 px-4 py-2 font-semibold rounded-md">
                            <i class="fa fa-eye mr-2"></i>
                            <p>View in API</p>
                        </a>
                        <button type="button" class="flex items-center text-xs bg-green-500 text-white hover:bg-green-600 hover:text-white transition ease duration-200 px-4 py-2 font-semibold rounded-md store-provider" provider-id="` + provider.providerId + `">
                            <i class="fa fa-save mr-2"></i>
                            Store
                        </button>
                    </div>
                </div>
            </div>`;
        }
    }

    pageNext()
    {
        this.page = this.nextPage;
        this.nextPage++;
        this.prevPage++;
        this.getPage(this.page).then(response => {
            if(response.data.totalPages < this.page) {
                this.pagePrev();
                return;
            }

            this.renderProviders(response.data.providers);
        });
    }

    pagePrev()
    {
        if(this.page == 1){
            return;
        }
        this.page = this.prevPage;
        this.nextPage--;
        this.prevPage--;
        this.getPage(this.page).then(response => {
            this.renderProviders(response.data.providers);
        });
    }
}