// ShoeHub Supabase & Application Configuration

const SUPABASE_URL = 'https://abvogxuydegfuavqpeoc.supabase.co';
const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImFidm9neHV5ZGVnZnVhdnFwZW9jIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODQ4MDAxMzMsImV4cCI6MjEwMDM3NjEzM30.QlLjvLNbSB1loEfmn2x-aLKc748xkZY-YvXEX7y-RDE';

// Initialize Supabase Client if URL is set up
var supabaseClient = null;
if (window.supabase && window.supabase.createClient && SUPABASE_URL && !SUPABASE_URL.includes('YOUR_SUPABASE_PROJECT_ID')) {
    try {
        supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
    } catch (e) {
        console.error('Supabase initialization failed:', e);
    }
}

// Fallback products in case Supabase credentials aren't configured yet
const SAMPLE_PRODUCTS = [
    { id: 1, name: 'Air Max 270', brand: 'Nike', description: 'Stylish running shoes with air cushioning.', material: 'Mesh & Rubber', size_available: '7, 8, 9, 10, 11', color: 'Black & Red', gender: 'Men', stock: 50, price: 13995.00, ratings: 4.7, reviews: 180, image_url: 'images/Air Max 270 (Nike).avif' },
    { id: 2, name: 'Ultraboost 22', brand: 'Adidas', description: 'Comfortable and high-performance running shoes.', material: 'Primeknit & Foam', size_available: '6, 7, 8, 9, 10', color: 'White & Blue', gender: 'Unisex', stock: 40, price: 17999.00, ratings: 4.8, reviews: 220, image_url: 'images/Ultraboost 22 (Adidas).jpg' },
    { id: 3, name: 'Wallabee', brand: 'Clarks', description: 'Classic leather casual shoes.', material: 'Suede Leather', size_available: '7, 8, 9, 10', color: 'Brown', gender: 'Men', stock: 30, price: 12000.00, ratings: 4.6, reviews: 95, image_url: 'images/Wallabee (Clarks).png' },
    { id: 4, name: 'Chuck Taylor All Star', brand: 'Converse', description: 'Iconic high-top sneakers.', material: 'Canvas & Rubber', size_available: '6, 7, 8, 9, 10', color: 'White', gender: 'Unisex', stock: 60, price: 5000.00, ratings: 4.5, reviews: 300, image_url: 'images/Chuck Taylor All Star (Converse).webp' },
    { id: 5, name: 'Stan Smith', brand: 'Adidas', description: 'Minimalistic tennis shoes with great comfort.', material: 'Synthetic Leather', size_available: '5, 6, 7, 8, 9', color: 'Green & White', gender: 'Unisex', stock: 45, price: 8999.00, ratings: 4.7, reviews: 250, image_url: 'images/Stan Smith (Adidas).avif' },
    { id: 6, name: 'Air Force 1', brand: 'Nike', description: 'Classic basketball shoes with a modern touch.', material: 'Leather', size_available: '7, 8, 9, 10, 11', color: 'Black', gender: 'Men', stock: 55, price: 11000.00, ratings: 4.8, reviews: 320, image_url: 'images/Air Force 1 (Nike).jpg' },
    { id: 7, name: 'Old Skool', brand: 'Vans', description: 'Skateboarding sneakers with timeless design.', material: 'Suede & Canvas', size_available: '6, 7, 8, 9', color: 'Black & White', gender: 'Unisex', stock: 70, price: 6000.00, ratings: 4.6, reviews: 200, image_url: 'images/Old Skool (Vans).webp' },
    { id: 8, name: 'Gel-Kayano 28', brand: 'ASICS', description: 'Stable and cushioned running shoes.', material: 'Mesh & Gel', size_available: '6, 7, 8, 9, 10', color: 'Blue & Yellow', gender: 'Men', stock: 35, price: 17000.00, ratings: 4.7, reviews: 140, image_url: 'images/Gel-Kayano 28 (ASICS).jpg' },
    { id: 9, name: 'Classic Clog', brand: 'Crocs', description: 'Lightweight and comfortable clogs.', material: 'EVA Foam', size_available: '5, 6, 7, 8, 9', color: 'Navy Blue', gender: 'Unisex', stock: 80, price: 3000.00, ratings: 4.4, reviews: 500, image_url: 'images/Classic Clog (Crocs).jpg' },
    { id: 10, name: 'Puma RS-X', brand: 'Puma', description: 'Chunky sneakers with retro styling.', material: 'Mesh & Suede', size_available: '7, 8, 9, 10', color: 'Red & White', gender: 'Men', stock: 45, price: 10000.00, ratings: 4.5, reviews: 130, image_url: 'images/Puma RS-X (Puma).webp' },
    { id: 11, name: 'Pegasus 39', brand: 'Nike', description: 'Everyday running shoes with excellent responsiveness.', material: 'Flyknit & Foam', size_available: '6, 7, 8, 9, 10', color: 'Gray & Black', gender: 'Unisex', stock: 50, price: 13000.00, ratings: 4.6, reviews: 210, image_url: 'images/Pegasus 39 (Nike).avif' },
    { id: 12, name: 'Yeezy Boost 350 V2', brand: 'Adidas', description: 'Trendy sneakers designed by Kanye West.', material: 'Primeknit & Boost', size_available: '7, 8, 9, 10', color: 'Zebra', gender: 'Unisex', stock: 20, price: 25000.00, ratings: 4.9, reviews: 400, image_url: 'images/Yeezy Boost 350 V2 (Adidas).avif' },
    { id: 13, name: 'Dr. Martens 1460', brand: 'Dr. Martens', description: 'Iconic combat boots with great durability.', material: 'Leather', size_available: '6, 7, 8, 9, 10', color: 'Black', gender: 'Unisex', stock: 25, price: 18000.00, ratings: 4.8, reviews: 310, image_url: 'images/Dr. Martens 1460 (Dr. Martens).jpg' },
    { id: 14, name: 'Reebok Club C 85', brand: 'Reebok', description: 'Classic tennis sneakers with a vintage feel.', material: 'Leather', size_available: '6, 7, 8, 9', color: 'White & Green', gender: 'Unisex', stock: 60, price: 7000.00, ratings: 4.5, reviews: 180, image_url: 'images/Reebok Club C 85 (Reebok).avif' },
    { id: 15, name: 'New Balance 574', brand: 'New Balance', description: 'Stylish retro running shoes.', material: 'Suede & Mesh', size_available: '7, 8, 9, 10', color: 'Gray & White', gender: 'Unisex', stock: 55, price: 6500.00, ratings: 4.6, reviews: 230, image_url: 'images/New Balance 574 (New Balance).jpg' }
];

// Local Storage Cart Helpers
const getCart = () => JSON.parse(localStorage.getItem('shoehub_cart') || '{}');
const saveCart = (cart) => localStorage.setItem('shoehub_cart', JSON.stringify(cart));

const addToCart = (product) => {
    const cart = getCart();
    const id = product.id;
    if (cart[id]) {
        cart[id].quantity += 1;
    } else {
        cart[id] = {
            id: product.id,
            name: product.name,
            price: Number(product.price),
            quantity: 1,
            image: product.image_url || product.image || 'images/default.jpg'
        };
    }
    saveCart(cart);
    alert(`${product.name} added to cart!`);
};
