<template>
    <div class="col-md-2 pr-0" style="background-color: #616161;">
        <div class="text-center">
            <h2 class="mt-5 mb-4" style="color: white">Shoe Brands</h2>
            <ul class="mb-5 pl-0 pr-0">
                <center>
                    <a v-for="(brand, index) in shoe_brands" :key="index" @click="searchShoeBrand(brand.name)" class="brand-anchor">
                        <li class="brand-list"> {{ brand.text }} </li>
                    </a>
                </center>
            </ul>
        </div>
    </div>
    <div class="col-md-10">
        <div class="card mt-2 mr-2">
            <div class="card-header p-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h3 class="mb-0 mr-3 font-weight-bold text-roboto"> Pick your fighter </h3>
                            <!-- v-if="count_num >= 3" -->
                            <button id="compare-shoe-btn" data-bs-toggle="modal" data-bs-target="#compareShoe" type="button" class="btn btn-danger"> FIGHT! </button>
                        </div>
                        <div class="col-md-3">
                            <input type="text" v-model="search" class="form-control" />
                            <span v-if="search_error" style="font-style: italic; color: red" class="font-weight-bold"> Please input keywords first </span>
                        </div>
                        <div class="col-md-1">
                            <button @click="searchSpecific()" type="button" class="btn btn-primary"> Search </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3 mb-3" id="go-here-comparison">
            <span v-for="(num, index) in count_num" :key="index">
                <a v-if="num == 2" class="p-2 mr-2 shoe-comparison-list"> {{ firstLetterUp(shoe_1.shoeName) }} <span style="padding-left: 20px; cursor: pointer" @click="removeShoe(num)"> X </span></a>
                <a v-else-if="num == 3" class="p-2 mr-2 shoe-comparison-list"> {{ firstLetterUp(shoe_2.shoeName) }} <span style="padding-left: 20px; cursor: pointer" @click="removeShoe(num)"> X </span></a>
                <a v-else-if="num == 4" class="p-2 shoe-comparison-list"> {{ firstLetterUp(shoe_3.shoeName) }} <span style="padding-left: 20px; cursor: pointer" @click="removeShoe(num)"> X </span></a>
            </span>
        </div>
        <div class="card mt-2 mr-2">
            <div class="card-body p-3 pt-2">
                <div class="row">
                    <div class="col-md-3 mt-4" v-for="(shoe, index) in shoe_list" :key="index">
                        <div class="card">
                            <img :src="shoe['thumbnail']" class="card-img-top p-3" alt="shoes">
                            <div class="card-body" style="margin: 2px solid black">
                                <h5 class="card-title text-roboto font-weight-bold">{{ firstLetterUp(shoe.shoeName) }}</h5>
                                <p class="card-text"> {{ this.changeAndCut(shoe.description) }} </p>
                                <p class="card-text" v-if="count_num != 4 && (shoe.shoeName != shoe_1.shoeName && shoe.shoeName != shoe_2.shoeName && shoe.shoeName != shoe_3.shoeName)">
                                    <a @click="pickMe(shoe)" class="pseudo-link" style="text-decoration: none"> Pick Me! (Shoe # {{ count_num }}) </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="compareShoe" tabindex="-1" aria-labelledby="compareShoeLabel" aria-hidden="true" style="padding-left: 0px !important">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-roboto font-weight-bold" id="compareShoeLabel"> Compare & Contrast </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container" v-if="count_num == 4">
                        <div class="row">
                            <div class="col-md-4 p-3">
                                <img :src="shoe_1.thumbnail" class="card-img-top p-3" alt="shoes">
                                <h4 class="font-weight-bold text-center"> {{ firstLetterUp(shoe_1.shoeName) }} </h4>
                            </div>
                            <div class="col-md-4">
                                <img :src="shoe_2.thumbnail" class="card-img-top p-3" alt="shoes">
                                <h4 class="font-weight-bold text-center"> {{ firstLetterUp(shoe_2.shoeName) }} </h4>
                            </div>
                            <div class="col-md-4">
                                <img :src="shoe_3.thumbnail" class="card-img-top p-3" alt="shoes">
                                <h4 class="font-weight-bold text-center"> {{ firstLetterUp(shoe_3.shoeName) }} </h4>
                            </div>
                        </div>
                        <h3 class="font-weight-bold mt-5"> Summary </h3>
                        <hr>
                        <!-- Brand -->
                        <div class="row ml-5">
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40">Brand</td>
                                        <td class="font-weight-bold pb-2"> {{ firstLetterUp(shoe_1.brand) }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40">Brand</td>
                                        <td class="font-weight-bold pb-2"> {{ firstLetterUp(shoe_2.brand) }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40">Brand</td>
                                        <td class="font-weight-bold pb-2"> {{ firstLetterUp(shoe_3.brand) }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Colorway -->
                        <div class="row ml-5">
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Colorway </td>
                                        <td class="font-weight-bold pb-2"> {{ shoe_1.colorway }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Colorway </td>
                                        <td class="font-weight-bold pb-2"> {{ shoe_2.colorway }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Colorway </td>
                                        <td class="font-weight-bold pb-2"> {{ shoe_3.colorway }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Release Date -->
                        <div class="row ml-5">
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Release Date </td>
                                        <td class="font-weight-bold pb-2"> {{ fixDateFormat(shoe_1.releaseDate) }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Release Date </td>
                                        <td class="font-weight-bold pb-2"> {{ fixDateFormat(shoe_2.releaseDate) }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Release Date </td>
                                        <td class="font-weight-bold pb-2"> {{ fixDateFormat(shoe_3.releaseDate) }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Retail Price -->
                        <div class="row ml-5">
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Retail Price </td>
                                        <td class="font-weight-bold pb-2"> $ {{ shoe_1.retailPrice }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Retail Price </td>
                                        <td class="font-weight-bold pb-2"> $ {{ shoe_2.retailPrice }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Retail Price </td>
                                        <td class="font-weight-bold pb-2"> $ {{ shoe_3.retailPrice }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Lowest Resell Price -->
                        <div class="row ml-5">
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Lowest <br>Resell Price </td>
                                        <td class="font-weight-bold pb-2"> $ {{ shoe_1.lowestResellPrice }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Lowest <br>Resell Price </td>
                                        <td class="font-weight-bold pb-2"> $ {{ shoe_2.lowestResellPrice }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Lowest <br>Resell Price </td>
                                        <td class="font-weight-bold pb-2"> $ {{ shoe_3.lowestResellPrice }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Link -->
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="mt-4"> 
                                    <a v-if="shoe_1.length != 0" :href="shoe_1.resellLinks.stockX" target="_blank"> {{ shoe_1.resellLinks.stockX }} </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mt-4"> 
                                    <a v-if="shoe_2.length != 0" :href="shoe_2.resellLinks.stockX" target="_blank"> {{ shoe_2.resellLinks.stockX }} </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mt-4"> 
                                    <a v-if="shoe_3.length != 0" :href="shoe_3.resellLinks.stockX" target="_blank"> {{ shoe_3.resellLinks.stockX }} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 2 comparison -->
                    <div class="container" v-else-if="count_num == 3">
                        <div class="row">
                            <div class="col-md-6 p-5">
                                <img :src="shoe_1.thumbnail" class="card-img-top p-3" alt="shoes">
                                <h4 class="font-weight-bold text-center"> {{ firstLetterUp(shoe_1.shoeName) }} Here</h4>
                            </div>
                            <div class="col-md-6 p-5">
                                <img :src="shoe_2.thumbnail" class="card-img-top p-3" alt="shoes">
                                <h4 class="font-weight-bold text-center"> {{ firstLetterUp(shoe_2.shoeName) }} </h4>
                            </div>
                        </div>
                        <h3 class="font-weight-bold mt-5"> Summary </h3>
                        <hr>
                        <!-- Brand -->
                        <div class="row ml-5">
                            <div class="col-md-6">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40">Brand</td>
                                        <td class="font-weight-bold pb-2"> {{ firstLetterUp(shoe_1.brand) }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40">Brand</td>
                                        <td class="font-weight-bold pb-2"> {{ firstLetterUp(shoe_2.brand) }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Colorway -->
                        <div class="row ml-5">
                            <div class="col-md-6">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Colorway </td>
                                        <td class="font-weight-bold pb-2"> {{ shoe_1.colorway }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Colorway </td>
                                        <td class="font-weight-bold pb-2"> {{ shoe_2.colorway }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Release Date -->
                        <div class="row ml-5">
                            <div class="col-md-6">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Release Date </td>
                                        <td class="font-weight-bold pb-2"> {{ fixDateFormat(shoe_1.releaseDate) }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Release Date </td>
                                        <td class="font-weight-bold pb-2"> {{ fixDateFormat(shoe_2.releaseDate) }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Retail Price -->
                        <div class="row ml-5">
                            <div class="col-md-6">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Retail Price </td>
                                        <td class="font-weight-bold pb-2"> $ {{ shoe_1.retailPrice }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Retail Price </td>
                                        <td class="font-weight-bold pb-2"> $ {{ shoe_2.retailPrice }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Lowest Resell Price -->
                        <div class="row ml-5">
                            <div class="col-md-6">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Lowest <br>Resell Price </td>
                                        <td class="font-weight-bold pb-2"> $ {{ shoe_1.lowestResellPrice }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2 w-40"> Lowest <br>Resell Price </td>
                                        <td class="font-weight-bold pb-2"> $ {{ shoe_2.lowestResellPrice }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Link -->
                        <div class="row text-center">
                            <div class="col-md-6">
                                <div class="mt-4"> 
                                    <a v-if="shoe_1.length != 0" :href="shoe_1.resellLinks.stockX" target="_blank"> {{ shoe_1.resellLinks.stockX }} </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-4"> 
                                    <a v-if="shoe_2.length != 0" :href="shoe_2.resellLinks.stockX" target="_blank"> {{ shoe_2.resellLinks.stockX }} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['auth'],
    data() {
        return {
            brand_name: 'All',
            shoe_list: [],
            individual_shoe: [],
            shoe_1 : [],
            shoe_2 : [],
            shoe_3 : [],
            count_num: 1,
            pages: 0,
            previous_page: -1,
            active_page: 0,
            next_page: 2,
            search: '',
            search_error: false,
            shoe_brands: [
                {
                    name: 'All',
                    text: 'All',
                    sold_average: 100
                },
                {
                    name: 'Adidas',
                    text: 'Adidas',
                    sold_average: 50
                },
                {
                    name: 'Asics',
                    text: 'Asics',
                    sold_average: 5
                },
                {
                    name: 'Birkenstock',
                    text: 'Birkenstock',
                    sold_average: 2
                },
                {
                    name: 'Burberry',
                    text: 'Burberry',
                    sold_average: 5
                },
                {
                    name: 'Converse',
                    text: 'Converse',
                    sold_average: 10
                },
                {
                    name: 'Crocs',
                    text: 'Crocs',
                    sold_average: 30
                },
                {
                    name: 'Jordan',
                    text: 'Jordan',
                    sold_average: 100
                },
                {
                    name: 'New Balance',
                    text: 'New Balance',
                    sold_average: 30
                },
                {
                    name: 'Nike',
                    text: 'Nike',
                    sold_average: 150
                },
                {
                    name: 'Puma',
                    text: 'Puma',
                    sold_average: 7
                },
                {
                    name: 'Under Armour',
                    text: 'Under Armour',
                    sold_average: 2
                },
                {
                    name: 'Vans',
                    text: 'Vans',
                    sold_average: 2
                },
            ]
        }
    },
    watch: {
        count_num() {
            if (this.count_num == 4) {
                document.getElementById("compare-shoe-btn").click();
            }
        }
    },
    mounted() {
        this.searchShoeBrand('All');
    },
    methods: {
        removeShoe(shoe) {
            if (shoe == 2) {
                // Remove first shoe
                this.shoe_1 = this.shoe_2
                this.shoe_2 = this.shoe_3
                this.shoe_3 = []
            } else if (shoe == 3) {
                // Remove second shoe
                this.shoe_2 = this.shoe_3
                this.shoe_3 = []
            } else if (shoe == 4) {
                // Remove third shoe
                this.shoe_3 = []
            }
            this.count_num -= 1
        },
        pickMe(shoe) {
            if (this.count_num == 1) {
                this.shoe_1 = shoe
                this.count_num += 1
                console.log('1')
                console.log(this.shoe_1)
            } else if (this.count_num == 2) {
                this.shoe_2 = shoe
                this.count_num += 1
                console.log('2')
                console.log(this.shoe_2)
            } else if (this.count_num == 3) {
                this.shoe_3 = shoe
                this.count_num += 1
                console.log('3')
                console.log(this.shoe_3)
            } else {
                //ERROR
                console.log('error')
            }
        },
        searchSpecific(page = 0, from_pages = false, count = 20,) {
            console.log(page)
            let search = this.search
            let brand = this.brand_name
            this.active_page = page
            if (brand == 'All') {
                console.log('here')
                brand = 'Sneakers shoes'
            }

            // Scroll to top
            var access = document.getElementById("go-here-comparison");
            access.scrollIntoView({behavior: 'smooth'}, true);

            if (search || page || (page == 0 && from_pages == true)) {
                axios.post('https://xw7sbct9v6-1.algolianet.com/1/indexes/products/query?x-algolia-agent=Algolia%20for%20vanilla%20JavaScript%203.32.1&x-algolia-application-id=XW7SBCT9V6&x-algolia-api-key=6b5e76b49705eb9f51a06d3c82f7acee', {
                    "params" : "query=${" + brand + " " + search + "}&facets=*&filters=&hitsPerPage=" + count + "&page=" + this.active_page + ""
                }).then(response => {
                    var json = response.data
                    var products = [];

                    this.pages = json.nbPages;
                    // this.pages = 5;

                    for (var i = 0; i < json.hits.length; i++) {
                        if (json.hits[i].product_category == 'sneakers' && (json.hits[i].brand.toLowerCase() == this.brand_name.toLowerCase() || this.brand_name == 'All')) {
                            var shoe = {
                                shoeName: json.hits[i].name,
                                brand: json.hits[i].brand,
                                silhoutte: json.hits[i].make,
                                styleID: json.hits[i].style_id,
                                colorway: json.hits[i].colorway,
                                retailPrice: json.hits[i].searchable_traits['Retail Price'],
                                thumbnail: json.hits[i].media.imageUrl,
                                releaseDate: json.hits[i].release_date,
                                description: json.hits[i].description,
                                urlKey: json.hits[i].url,
                                sold: json.hits[i].deadstock_sold,
                                last_72: json.hits[i].sales_last_72,
                                resellLinks: {
                                    stockX: 'https://stockx.com/' + json.hits[i].url
                                }
                            };
                            if(json.hits[i].lowest_ask){
                                shoe.lowestResellPrice = json.hits[i].lowest_ask;
                            }
                            products.push(shoe)
                        }
                    }
                    this.shoe_list = products
                });
                this.search_error = false
            } else {
                this.search_error = true
            }
            
        },
        searchShoeBrand(brand, count = 20) {
            this.brand_name = brand
            this.search = ''
            this.active_page = 0
            if (brand == 'All') {
                brand = 'Sneakers Shoes'
            }

            axios.post('https://xw7sbct9v6-1.algolianet.com/1/indexes/products/query?x-algolia-agent=Algolia%20for%20vanilla%20JavaScript%203.32.1&x-algolia-application-id=XW7SBCT9V6&x-algolia-api-key=6b5e76b49705eb9f51a06d3c82f7acee', {
                "params" : "query=${" + brand + "}&facets=*&filters=&hitsPerPage=" + count + "&page=" + this.active_page + ""
            }).then(response => {
                var json = response.data
                var products = [];
                // var numOfShoes = json.hits.length;

                this.pages = json.nbPages;
                // this.pages = 5

                for (var i = 0; i < json.hits.length; i++) {
                    if (json.hits[i].product_category == 'sneakers') {
                        // if (!json.hits[i].style_id || (json.hits[i].style_id).indexOf(' ') >= 0) {
                        //     numOfShoes--;
                        //     continue;
                        // }
                        var shoe = {
                            shoeName: json.hits[i].name,
                            brand: json.hits[i].brand,
                            silhoutte: json.hits[i].make,
                            styleID: json.hits[i].style_id,
                            colorway: json.hits[i].colorway,
                            retailPrice: json.hits[i].searchable_traits['Retail Price'],
                            thumbnail: json.hits[i].media.imageUrl,
                            releaseDate: json.hits[i].release_date,
                            description: json.hits[i].description,
                            sold: json.hits[i].deadstock_sold,
                            last_72: json.hits[i].sales_last_72,
                            urlKey: json.hits[i].url,
                            resellLinks: {
                                stockX: 'https://stockx.com/' + json.hits[i].url
                            }
                        };
                        if(json.hits[i].lowest_ask){
                            shoe.lowestResellPrice = json.hits[i].lowest_ask;
                        }
                        products.push(shoe)
                    }
                }
                this.shoe_list = products
            });
        },
        changeAndCut(desc) {
            if (desc) {
                var newDesc = ''
                newDesc = desc.slice(0, desc.indexOf('.')).replaceAll(/<br>/g, '\n')

                return newDesc
            }
        },
        changeNewLine(desc) {
            if (desc) {
                var newDesc = ''
                newDesc = desc.replaceAll(/<br>/g, '\n')

                return newDesc
            }
        },
        firstLetterUp(word) {
            if (word) {
                let str = '';
                str = word.charAt(0).toUpperCase() + word.slice(1)

                return str
            }
        },
        fixDateFormat(date) {
            if (date) {
                var newDate = date + ' 00:00:00'


                return moment(newDate).format('LL')
            }
        },
        formatNum(num) {
            if (num) {
                return num.toLocaleString('en-US')
            }
        }
    }
}
</script>