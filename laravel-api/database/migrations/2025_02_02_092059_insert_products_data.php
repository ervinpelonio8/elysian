<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class InsertProductsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('products')->insert([
            [
                'name' => 'Classic Denim Jacket',
                'description' => 'This iconic denim jacket is perfect for all occasions. With its rugged charm and timeless appeal, it’s great for layering over a T-shirt or pairing with casual jeans. A wardrobe staple for any season. (Unisex)',
                'quantity' => 50,
                'sold_count' => 0,
                'image' => 'images/products/denim1.jpg',
                'price' => 1200
            ],
            [
                'name' => 'Slim Fit Black Jeans',
                'description' => 'A perfect blend of comfort and style. These slim-fit black jeans are versatile enough for both formal and casual occasions. Their stretch fabric ensures all-day comfort without compromising on style. (Men)',
                'quantity' => 30,
                'sold_count' => 0,
                'image' => 'images/products/Slim Fit Black Jeans.jpg',
                'price' => 950
            ],
            [
                'name' => 'Oversized Hoodie',
                'description' => 'Stay cozy and stylish with this oversized hoodie. Whether you’re lounging around or hitting the streets, this hoodie offers warmth, comfort, and an effortlessly cool look. A must-have for every casual wardrobe. (Unisex)',
                'quantity' => 40,
                'sold_count' => 0,
                'image' => 'images/products/Oversized Hoodie.jpg',
                'price' => 1500
            ],
            [
                'name' => 'Red Plaid Shirt',
                'description' => 'Get a bold and trendy look with this red plaid shirt. Made from soft, breathable fabric, it’s perfect for cooler days. Wear it on its own or layer it over a T-shirt for a relaxed, effortlessly cool vibe. (Men)',
                'quantity' => 20,
                'sold_count' => 0,
                'image' => 'images/products/Red Plaid Shirt.jpg',
                'price' => 1100
            ],
            [
                'name' => 'Stylish Leather Jacket',
                'description' => 'Elevate your wardrobe with this premium leather jacket. Designed for those who appreciate quality and style, this jacket is perfect for a night out or casual daily wear. The sleek, edgy design will make you stand out wherever you go. (Men)',
                'quantity' => 15,
                'sold_count' => 0,
                'image' => 'images/products/Stylish Leather Jacket.jpg',
                'price' => 3500
            ],
            [
                'name' => 'Floral Summer Dress',
                'description' => 'This delicate floral summer dress is perfect for sunny days and warm evenings. With a flattering fit and feminine design, it’s ideal for picnics, parties, or just enjoying a stroll in the park. Light and breezy for ultimate comfort. (Women)',
                'quantity' => 60,
                'sold_count' => 0,
                'image' => 'images/products/Floral Summer Dress.jpg',
                'price' => 1800
            ],
            [
                'name' => 'Men\'s White Dress Shirt',
                'description' => 'An absolute essential for any formal occasion. This men’s white dress shirt offers a crisp, clean look with its sharp collar and slim fit design. Perfect for office wear, weddings, or any event that calls for sophistication. (Men)',
                'quantity' => 25,
                'sold_count' => 0,
                'image' => 'images/products/Men White Dress Shirt.jpg',
                'price' => 1300
            ],
            [
                'name' => 'High-Waisted Skinny Jeans',
                'description' => 'Shape and style come together in these high-waisted skinny jeans. With a flattering fit and plenty of stretch, they’re perfect for everything from casual weekends to dressy evenings. Pair them with a simple T-shirt or dress them up with a blouse. (Women)',
                'quantity' => 35,
                'sold_count' => 0,
                'image' => 'images/products/High-Waisted Skinny Jeans.jpg',
                'price' => 1200
            ],
            [
                'name' => 'Cargo Pants for Men',
                'description' => 'For those who need functionality and style, these men’s cargo pants are ideal. With multiple pockets and a relaxed fit, they’re perfect for outdoor activities, casual outings, or a day at work. Durable and easy-going, these pants are built to last. (Men)',
                'quantity' => 50,
                'sold_count' => 0,
                'image' => 'images/products/Cargo Pants for Men.jpg',
                'price' => 1400
            ],
            [
                'name' => 'Maxi Skirt',
                'description' => 'This flowy maxi skirt is a wardrobe favorite for those who appreciate elegant and breezy fashion. Whether you’re heading to the beach or out to brunch, this skirt adds a graceful touch to any outfit. Available in multiple colors and prints. (Women)',
                'quantity' => 55,
                'sold_count' => 0,
                'image' => 'images/products/Maxi Skirt.jpg',
                'price' => 1350
            ],
            [
                'name' => 'Men Bomber Jacket',
                'description' => 'This men’s bomber jacket is the perfect blend of style and function. Designed for those who appreciate both fashion and comfort, it features a sleek design, ribbed cuffs, and a versatile look that can be paired with almost anything. (Men)',
                'quantity' => 40,
                'sold_count' => 0,
                'image' => 'images/products/Men Bomber Jacket.jpg',
                'price' => 2000
            ],
            [
                'name' => 'Sweater Dress',
                'description' => 'This cozy sweater dress is perfect for chilly weather. Soft, warm, and flattering, it pairs well with boots and tights for a stylish and practical outfit. Perfect for fall and winter days, it’s a must-have for any fashion-forward wardrobe. (Women)',
                'quantity' => 50,
                'sold_count' => 0,
                'image' => 'images/products/Sweater Dress.jpg',
                'price' => 1700
            ],
            [
                'name' => 'Puffer Jacket',
                'description' => 'This puffer jacket is built for winter adventures. With its lightweight yet warm design, it’s ideal for outdoor activities and chilly urban walks. Stay warm while keeping your style intact with this winter essential. (Unisex)',
                'quantity' => 30,
                'sold_count' => 0,
                'image' => 'images/products/Puffer Jacket.jpg',
                'price' => 2200
            ],
            [
                'name' => 'Denim Skirt',
                'description' => 'A timeless piece for any closet, this denim skirt is perfect for casual outings or dressy events. It offers comfort and flexibility with a flattering fit that pairs effortlessly with any top or jacket. (Women)',
                'quantity' => 60,
                'sold_count' => 0,
                'image' => 'images/products/Denim Skirt.jpg',
                'price' => 1050
            ],
            [
                'name' => 'Vintage Sweatshirt',
                'description' => 'This vintage-style sweatshirt brings back the charm of retro fashion with a modern twist. Soft, cozy, and perfect for layering, it’s ideal for laid-back days and casual nights out. (Unisex)',
                'quantity' => 45,
                'sold_count' => 0,
                'image' => 'images/products/Vintage Sweatshirt.jpg',
                'price' => 1250
            ],
            [
                'name' => 'Harem Pants',
                'description' => 'These relaxed harem pants are perfect for a laid-back day or yoga session. With a comfortable fit and stylish drape, they’re ideal for both casual wear and active days. Available in various colors and prints. (Women)',
                'quantity' => 50,
                'sold_count' => 0,
                'image' => 'images/products/Harem Pants.jpg',
                'price' => 900
            ],
            [
                'name' => 'Chino Pants for Men',
                'description' => 'Stylish and practical, these men’s chino pants are perfect for office wear or casual outings. Made with soft cotton, they offer a clean, sharp look while providing all-day comfort. Pair them with a dress shirt or a T-shirt for versatility. (Men)',
                'quantity' => 35,
                'sold_count' => 0,
                'image' => 'images/products/Chino Pants for Men.jpg',
                'price' => 1600
            ],
            [
                'name' => 'V-Neck Knit Sweater',
                'description' => 'This soft knit sweater features a flattering V-neck design, perfect for layering or wearing on its own. It offers comfort without compromising style, making it a great choice for casual days or layering for a cozy look. (Women)',
                'quantity' => 30,
                'sold_count' => 0,
                'image' => 'images/products/V-Neck Knit Sweater.jpg',
                'price' => 1600
            ],
            [
                'name' => 'Slim Fit Blazer',
                'description' => 'This slim-fit blazer is designed for the modern man who values a sharp, professional look. Whether it’s for work or a night out, this versatile piece will have you looking stylish and confident. (Men)',
                'quantity' => 20,
                'sold_count' => 0,
                'image' => 'images/products/Slim Fit Blazer.jpg',
                'price' => 2500
            ],
            [
                'name' => 'Tie-Dye Hoodie',
                'description' => 'A throwback to vintage style, this tie-dye hoodie brings together comfort and flair. Made of soft cotton, it’s perfect for lounging, outdoor activities, or simply showing off your bold personality. (Unisex)',
                'quantity' => 35,
                'sold_count' => 0,
                'image' => 'images/products/Tie-Dye Hoodie.jpg',
                'price' => 1300
            ],
            [
                'name' => 'Flannel Pajama Set',
                'description' => 'Sleep in ultimate comfort with this flannel pajama set. Made from soft, breathable cotton, it’s perfect for cozy nights in. This classic plaid pattern never goes out of style, and its relaxed fit ensures a restful sleep. (Women)',
                'quantity' => 50,
                'sold_count' => 0,
                'image' => 'images/products/Flannel Pajama Set.jpg',
                'price' => 1700
            ],
            [
                'name' => 'Denim Overalls',
                'description' => 'Stay stylish and practical with these classic denim overalls. Whether you’re working in the garden or out with friends, these durable overalls provide comfort and easy movement, while the trendy design adds a cool vibe. (Unisex)',
                'quantity' => 45,
                'sold_count' => 0,
                'image' => 'images/products/Denim Overalls.jpg',
                'price' => 1800
            ],
            [
                'name' => 'High-Waisted Trousers',
                'description' => 'Perfect for both office wear and casual outings, these high-waisted trousers offer a sleek silhouette and modern style. Their versatile design allows them to be paired with both blouses and T-shirts, offering endless styling options. (Women)',
                'quantity' => 40,
                'sold_count' => 0,
                'image' => 'images/products/High-Waisted Trousers.jpg',
                'price' => 1400
            ],
            [
                'name' => 'Hooded Sweatshirt Dress',
                'description' => 'This casual hoodie dress offers both style and comfort. Perfect for those chilly days when you want to feel cozy and look effortlessly stylish. The oversized fit gives it a relaxed, laid-back feel. (Women)',
                'quantity' => 30,
                'sold_count' => 0,
                'image' => 'images/products/Hooded Sweatshirt Dress.jpg',
                'price' => 1500
            ],
            [
                'name' => 'Baseball Cap',
                'description' => 'Keep the sun out of your eyes in style with this classic baseball cap. Whether you’re hitting the gym or hanging out with friends, this cap is the perfect accessory for a casual look. (Unisex)',
                'quantity' => 80,
                'sold_count' => 0,
                'image' => 'images/products/Baseball Cap.jpg',
                'price' => 600
            ],
            [
                'name' => 'Bootcut Jeans',
                'description' => 'These bootcut jeans feature a tailored fit that flares out slightly from the knee, creating a flattering silhouette. Perfect for pairing with boots or sneakers, these jeans are both stylish and comfortable for any occasion. (Women)',
                'quantity' => 25,
                'sold_count' => 0,
                'image' => 'images/products/Bootcut Jeans.jpg',
                'price' => 1300
            ],
            [
                'name' => 'Graphic T-Shirt',
                'description' => 'This graphic T-shirt brings a fun, edgy vibe to your casual wardrobe. With a bold, unique design, it’s perfect for expressing your personality while staying comfortable throughout the day. (Unisex)',
                'quantity' => 50,
                'sold_count' => 0,
                'image' => 'images/products/Graphic T-Shirt.jpg',
                'price' => 900
            ],
            [
                'name' => 'Quilted Jacket',
                'description' => 'This quilted jacket offers lightweight warmth with a stylish design. Perfect for transitional weather, it adds a chic touch to any outfit while keeping you cozy and protected from the cold. (Unisex)',
                'quantity' => 35,
                'sold_count' => 0,
                'image' => 'images/products/Quilted Jacket.jpg',
                'price' => 2200
            ],
            [
                'name' => 'Leopard Print Skirt',
                'description' => 'Add a touch of boldness to your wardrobe with this leopard print skirt. The flattering fit hugs your curves, and the animal print adds a daring edge to your outfit. Perfect for both casual days and evening outings. (Women)',
                'quantity' => 40,
                'sold_count' => 0,
                'image' => 'images/products/Leopard Print Skirt.jpg',
                'price' => 1250
            ],
            [
                'name' => 'Turtle Neck Sweater',
                'description' => 'Keep warm in style with this classic turtle neck sweater. Perfect for layering or wearing alone, it’s a versatile piece that adds a sleek, polished look to any outfit. Great for the colder months. (Men)',
                'quantity' => 45,
                'sold_count' => 0,
                'image' => 'images/products/Turtle Neck Sweater.jpg',
                'price' => 1400
            ],
            [
                'name' => 'Athletic Shorts',
                'description' => 'Stay cool during your workouts with these breathable athletic shorts. With a comfortable fit and moisture-wicking fabric, they’re designed to keep you focused on your performance, not on your gear. (Unisex)',
                'quantity' => 60,
                'sold_count' => 0,
                'image' => 'images/products/Athletic Shorts.jpg',
                'price' => 950
            ],
            [
                'name' => 'Double-Breasted Coat',
                'description' => 'This stylish double-breasted coat brings sophistication and warmth together. Whether you’re heading to work or out for a date night, this coat is the perfect outerwear for any occasion. (Women)',
                'quantity' => 30,
                'sold_count' => 0,
                'image' => 'images/products/Double-Breasted Coat.jpg',
                'price' => 2500
            ],
            [
                'name' => 'Sailor Collar Dress',
                'description' => 'Embrace a nautical-inspired style with this sailor collar dress. With its playful design and flattering silhouette, it’s perfect for casual outings or day trips. Comfortable and chic! (Women)',
                'quantity' => 55,
                'sold_count' => 0,
                'image' => 'images/products/Sailor Collar Dress.jpg',
                'price' => 1500
            ],
            [
                'name' => 'Chunky Knit Sweater',
                'description' => 'Stay cozy in this oversized chunky knit sweater. With its thick texture and relaxed fit, it’s the perfect piece for colder weather, offering warmth and style in one comfortable package. (Unisex)',
                'quantity' => 40,
                'sold_count' => 0,
                'image' => 'images/products/Chunky Knit Sweater.jpg',
                'price' => 1800
            ],
            [
                'name' => 'Mini Skirt',
                'description' => 'This mini skirt is a wardrobe essential for those who love bold, youthful fashion. Made with soft fabric, it’s comfortable and stylish for both casual and semi-dressy occasions. (Women)',
                'quantity' => 45,
                'sold_count' => 0,
                'image' => 'images/products/Mini Skirt.jpg',
                'price' => 1100
            ],
            [
                'name' => 'Cargo Shorts',
                'description' => 'Comfort meets functionality in these cargo shorts. With multiple pockets and a loose fit, they’re perfect for outdoor activities or casual days out. Made from breathable material, they’re designed for summer fun. (Unisex)',
                'quantity' => 50,
                'sold_count' => 0,
                'image' => 'images/products/Cargo Shorts.jpg',
                'price' => 1000
            ],
            [
                'name' => 'Cropped Denim Jacket',
                'description' => 'This cropped denim jacket offers a fresh take on a classic piece. With its edgy, modern design, it’s the perfect layering item for any casual outfit. Paired with jeans, skirts, or dresses, it adds instant cool factor. (Women)',
                'quantity' => 60,
                'sold_count' => 0,
                'image' => 'images/products/Cropped Denim Jacket.jpg',
                'price' => 1700
            ],
            [
                'name' => 'Peacoat',
                'description' => 'This peacoat is a timeless outerwear choice that never goes out of style. Crafted from high-quality wool, it’s perfect for chilly weather and adds a polished look to any outfit. (Men)',
                'quantity' => 35,
                'sold_count' => 0,
                'image' => 'images/products/Peacoat.jpg',
                'price' => 2800
            ],
            [
                'name' => 'Varsity Jacket',
                'description' => 'This stylish varsity jacket brings a sporty yet fashionable twist to your wardrobe. With bold color-blocking details and ribbed cuffs, it’s the perfect outerwear to express your unique style. (Unisex)',
                'quantity' => 40,
                'sold_count' => 0,
                'image' => 'images/products/Varsity Jacket.jpg',
                'price' => 2100
            ],
            [
                'name' => 'Denim Jacket with Faux Fur Lining',
                'description' => 'A classic denim jacket revamped with cozy faux fur lining. Perfect for those chilly days, this jacket brings warmth without sacrificing style. Its versatile design pairs well with both casual and semi-casual outfits. (Women)',
                'quantity' => 50,
                'sold_count' => 0,
                'image' => 'images/products/Denim Jacket with Faux Fur Lining.jpg',
                'price' => 2500
            ],
            [
                'name' => 'Plaid Flannel Shirt',
                'description' => 'This warm plaid flannel shirt is a timeless piece that pairs well with almost anything. Made with soft cotton, it’s perfect for layering over a T-shirt or wearing solo for a relaxed, rustic vibe. (Unisex)',
                'quantity' => 55,
                'sold_count' => 0,
                'image' => 'images/products/Plaid Flannel Shirt.jpg',
                'price' => 1300
            ],
            [
                'name' => 'Knitted Beanie',
                'description' => 'Keep your head warm and stylish with this knitted beanie. Whether you’re running errands or out on a winter hike, this soft, snug beanie adds a pop of color and warmth to your winter wardrobe. (Unisex)',
                'quantity' => 70,
                'sold_count' => 0,
                'image' => 'images/products/Knitted Beanie.jpg',
                'price' => 600
            ],
            [
                'name' => 'Luxe Wool Scarf',
                'description' => 'Add elegance and warmth to your winter look with this luxe wool scarf. Perfect for draping over your shoulders or wrapping around your neck, it’s a versatile accessory that complements any outfit. (Unisex)',
                'quantity' => 45,
                'sold_count' => 0,
                'image' => 'images/products/Luxe Wool Scarf.jpg',
                'price' => 1800
            ],
            [
                'name' => 'Striped Midi Skirt',
                'description' => 'A bold yet elegant midi skirt featuring eye-catching stripes. Perfect for both casual and dressier occasions, it’s easy to dress up or down. The flattering cut offers a comfortable fit and a stylish appearance. (Women)',
                'quantity' => 60,
                'sold_count' => 0,
                'image' => 'images/products/Striped Midi Skirt.jpg',
                'price' => 1400
            ],
            [
                'name' => 'Slim Fit Chinos',
                'description' => 'These slim-fit chinos offer a sleek, tailored look while maintaining comfort and versatility. The stretchable fabric ensures ease of movement, making these trousers perfect for work or casual outings. (Men)',
                'quantity' => 45,
                'sold_count' => 0,
                'image' => 'images/products/Slim Fit Chinos.jpg',
                'price' => 1800
            ],
            [
                'name' => 'Bomber Jacket',
                'description' => 'A trendy bomber jacket that’s perfect for casual outings and evening hangs. Its lightweight design and stylish ribbed cuffs and collar provide a comfortable yet edgy look. Great for layering over hoodies or T-shirts. (Unisex)',
                'quantity' => 50,
                'sold_count' => 0,
                'image' => 'images/products/Bomber Jacket.jpg',
                'price' => 2200
            ],
            [
                'name' => 'Sweatpants Joggers',
                'description' => 'These sweatpants joggers offer all-day comfort with a stylish twist. Made with soft, breathable fabric, they’re perfect for lounging, running errands, or heading to the gym. The tapered fit ensures a sleek look. (Unisex)',
                'quantity' => 65,
                'sold_count' => 0,
                'image' => 'images/products/Sweatpants Joggers.jpg',
                'price' => 1200
            ],
            [
                'name' => 'Boho Chic Kimono',
                'description' => 'Embrace free-spirited style with this beautiful boho chic kimono. With its flowing sleeves and intricate floral patterns, it’s perfect for adding a touch of elegance to any outfit, whether at the beach or a casual dinner. (Women)',
                'quantity' => 40,
                'sold_count' => 0,
                'image' => 'images/products/Boho Chic Kimono.jpg',
                'price' => 2000
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('products')->truncate();
    }
}
