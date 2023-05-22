<template>
    <div class="col-md-2 pr-0" style="background-color: #616161;">
        <div class="text-center">
            <h2 class="mt-5 mb-4" style="color: white">Shoe Brands</h2>
            <ul class="mb-5 pl-0 pr-0">
                <center>
                    <a v-for="(brand, index) in shoe_brands" :key="index" @click="mostPopular(brand.name)" class="brand-anchor">
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
                        <div class="col-md-8">
                            <h3 v-if="brand_name" class="mb-0 font-weight-bold text-roboto"> Most Popular - {{ brand_name }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2 mr-2">
            <div class="card-body p-3 pt-2">
                <div class="row">
                    <div class="col-md-3 mt-4" v-for="(shoe, index) in shoe_list" :key="index">
                        <div class="card" v-if="index <= 19">
                            <img :src="shoe['thumbnail']" class="card-img-top p-3" alt="shoes">
                            <div class="card-body" style="margin: 2px solid black">
                                <h5 class="card-title text-roboto font-weight-bold">{{ firstLetterUp(shoe.shoeName) }} - {{ shoe.sold }} </h5>
                                <p class="card-text">
                                    Colorway: {{ shoe.colorway }}
                                </p>
                                <p class="card-text">
                                    <a @click="seeMore(shoe)" class="pseudo-link" data-bs-toggle="modal" data-bs-target="#checkShoePopular"> See More </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="checkShoePopular" tabindex="-1" aria-labelledby="checkShoePopularLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-roboto font-weight-bold" id="checkShoePopularLabel"> {{ firstLetterUp(individual_shoe.shoeName) }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <img :src="individual_shoe.thumbnail" class="card-img-top p-3" alt="shoes">
                            </div>
                        </div>
                        <h4 class="text-roboto font-weight-bold mb-4"> Product Details </h4>
                        <div class="row">
                            <div class="col-md-5">
                                <table class="w-100">
                                    <tr>
                                        <td class="pb-2">Brand</td>
                                        <td class="font-weight-bold pb-2"> {{ firstLetterUp(individual_shoe.brand) }} </td>
                                    </tr>
                                    <tr>
                                        <td class="pb-2"> Colorway </td>
                                        <td class="font-weight-bold pb-2"> {{ individual_shoe.colorway }} </td>
                                    </tr>
                                    <tr>
                                        <td class="pb-2"> Release Date </td>
                                        <td class="font-weight-bold pb-2"> {{ fixDateFormat(individual_shoe.releaseDate) }} </td>
                                    </tr>
                                    <tr>
                                        <td class="pb-2"> Retail Price </td>
                                        <td class="font-weight-bold pb-2"> $ {{ individual_shoe.retailPrice }} </td>
                                    </tr>
                                    <tr>
                                        <td class="pb-2"> Lowest <br>Resell Price </td>
                                        <td class="font-weight-bold pb-2"> $ {{ individual_shoe.lowestResellPrice }} </td>
                                    </tr>
                                </table>
                                <div class="mt-4"> 
                                    <a v-if="individual_shoe.length != 0" :href="individual_shoe.resellLinks.stockX" target="_blank"> {{ individual_shoe.resellLinks.stockX }} </a>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <h6 class="font-weight-bold"> Product Description (if there's any) </h6>
                                <p> {{ this.changeNewLine(individual_shoe.description) }} </p>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            brand_name: '',
            shoe_list: [],
            individual_shoe: [],
            all_pages: 0,
            page: 0,
            num_of_shoes: 0,
            shoe_brands: [
                {
                    name: 'All',
                    text: 'All',
                    sold_average: 20000
                },
                {
                    name: 'Adidas',
                    text: 'Adidas',
                    sold_average: 20000
                },
                {
                    name: 'Asics',
                    text: 'Asics',
                    sold_average: 300
                },
                {
                    name: 'Birkenstock',
                    text: 'Birkenstock',
                    sold_average: 100
                },
                {
                    name: 'Burberry',
                    text: 'Burberry',
                    sold_average: 50
                },
                {
                    name: 'Converse',
                    text: 'Converse',
                    sold_average: 1000
                },
                {
                    name: 'Crocs',
                    text: 'Crocs',
                    sold_average: 1000
                },
                {
                    name: 'Jordan',
                    text: 'Jordan',
                    sold_average: 20000
                },
                {
                    name: 'New Balance',
                    text: 'New Balance',
                    sold_average: 4000
                },
                {
                    name: 'Nike',
                    text: 'Nike',
                    sold_average: 20000
                },
                {
                    name: 'Puma',
                    text: 'Puma',
                    sold_average: 1000
                },
                {
                    name: 'Under Armour',
                    text: 'Under Armour',
                    sold_average: 200
                },
                {
                    name: 'Vans',
                    text: 'Vans',
                    sold_average: 200
                },
            ]
        }
    },
    mounted() {
        this.mostPopular('All');
    },
    methods: {
        mostPopular(brand) {
            this.brand_name = brand
            var current_brand = ''

            // Get shoe brand deadstock average value
            this.shoe_brands.forEach((brand) => {
                if (brand.name == this.brand_name) {
                    console.log(brand.name)
                    current_brand = brand
                }
            })

            if (brand == 'All') {
                brand = 'sneakers shoes'
            }
            this.shoe_list = []

            axios.post('https://xw7sbct9v6-1.algolianet.com/1/indexes/products/query?x-algolia-agent=Algolia%20for%20vanilla%20JavaScript%203.32.1&x-algolia-application-id=XW7SBCT9V6&x-algolia-api-key=6b5e76b49705eb9f51a06d3c82f7acee', {
                "params" : "query=${" + brand + "}&facets=*&filters=&hitsPerPage=20"
            }).then(response => {
                // var json2 = response.data
                var products = [];
                this.num_of_shoes = 0;

                if (response.data.nbPages <= 10) {
                    this.all_pages = response.data.nbPages;
                } else {
                    this.all_pages = 10
                }

                for (var numOfPages = 0; numOfPages < this.all_pages; numOfPages++) {
                    // products = []
                    // New Axios Request
                    axios.post('https://xw7sbct9v6-1.algolianet.com/1/indexes/products/query?x-algolia-agent=Algolia%20for%20vanilla%20JavaScript%203.32.1&x-algolia-application-id=XW7SBCT9V6&x-algolia-api-key=6b5e76b49705eb9f51a06d3c82f7acee', {
                        "params" : "query=${" + brand + "}&facets=*&filters=&hitsPerPage=100&page=" + numOfPages + "",
                    }).then(response => {
                        var json = response.data

                        for (var i = 0; i < json.hits.length; i++) {
                            if (json.hits[i].product_category == 'sneakers'  && json.hits[i].deadstock_sold >= current_brand.sold_average && (json.hits[i].brand.toLowerCase() == this.brand_name.toLowerCase() || this.brand_name == 'All')) {
                                var shoe = {
                                    shoeName: json.hits[i].name,
                                    brand: json.hits[i].brand,
                                    // silhoutte: json.hits[i].make,
                                    // styleID: json.hits[i].style_id,
                                    colorway: json.hits[i].colorway,
                                    retailPrice: json.hits[i].searchable_traits['Retail Price'],
                                    thumbnail: json.hits[i].media.imageUrl,
                                    releaseDate: json.hits[i].release_date,
                                    description: json.hits[i].description,
                                    // urlKey: json.hits[i].url,
                                    resellLinks: {
                                        stockX: 'https://stockx.com/' + json.hits[i].url
                                    },
                                    sold: json.hits[i].deadstock_sold
                                };
                                if(json.hits[i].lowest_ask){
                                    shoe.lowestResellPrice = json.hits[i].lowest_ask;
                                }

                                this.shoe_list.push(shoe)
                            }
                        }
                    });
                }

                this.fixShoeList();
            });
        },
        fixShoeList() {
            var arr = [];
            var list = this.shoe_list
            for (var prop in list) {
                if (list.hasOwnProperty(prop)) {
                    arr.push({
                        'key': prop,
                        'sold': list[prop]
                    });
                }
            }
            arr.sort(function(a, b) { return b.sold - a.sold; });
            //arr.sort(function(a, b) { return a.value.toLowerCase().localeCompare(b.value.toLowerCase()); }); //use this to sort as strings
            this.shoe_list = [];
            this.shoe_list = arr;
            console.log(this.shoe_list)
        },
        seeMore(shoe) {
            this.individual_shoe = []
            this.individual_shoe = shoe
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
    }
}
</script>