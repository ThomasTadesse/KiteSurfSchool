<!-- Compact Search Form -->
                <div class="w-full md:w-auto">
                    <button id="toggleFilters" class="flex items-center text-blue-600 mb-2 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Filters {{ isset($searchInvoiceNumber) || isset($searchCustomer) || isset($searchStatus) || isset($searchDateFrom) || isset($searchDateTo) ? '(Actief)' : '' }}
                    </button>
                    
                    <div id="filterSection" class="{{ isset($searchInvoiceNumber) || isset($searchCustomer) || isset($searchStatus) || isset($searchDateFrom) || isset($searchDateTo) ? '' : 'hidden' }} bg-gray-50 p-3 rounded-md mb-3">
                        <form method="GET" action="{{ route('invoices.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                            <div>
                                <input type="text" name="searchInvoiceNumber" id="searchInvoiceNumber" placeholder="Factuurnummer" value="{{ $searchInvoiceNumber ?? '' }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <input type="text" name="searchCustomer" id="searchCustomer" placeholder="Klant" value="{{ $searchCustomer ?? '' }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <select name="searchStatus" id="searchStatus" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Alle statussen</option>
                                    <option value="paid" {{ isset($searchStatus) && $searchStatus == 'paid' ? 'selected' : '' }}>Betaald</option>
                                    <option value="unpaid" {{ isset($searchStatus) && $searchStatus == 'unpaid' ? 'selected' : '' }}>Onbetaald</option>
                                </select>
                            </div>
                            <div>
                                <input type="date" name="searchDateFrom" id="searchDateFrom" placeholder="Datum vanaf" value="{{ $searchDateFrom ?? '' }}" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <input type="date" name="searchDateTo" id="searchDateTo" placeholder="Datum tot" value="{{ $searchDateTo ?? '' }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div class="flex gap-2 items-center">
                                <button type="submit" class="flex-1 bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600">
                                    Zoeken
                                </button>
                                @if(isset($searchInvoiceNumber) || isset($searchCustomer) || isset($searchStatus) || isset($searchDateFrom) || isset($searchDateTo))
                                    <a href="{{ route('invoices.index') }}" class="flex-1 bg-gray-500 text-white px-3 py-2 rounded-md hover:bg-gray-600 text-center">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </form>