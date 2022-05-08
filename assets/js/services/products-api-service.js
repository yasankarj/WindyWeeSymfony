import axios from 'axios';

const ProductsApiService = {
    fetchProducts(params) {
        return axios.get('/api/products', {
            //js shorthand of params: params
            params,
        });
    },
};
export default ProductsApiService;
