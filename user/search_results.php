<?php
require_once 'header.php';
require_once 'config.php';

$query = isset($_GET['query']) ? $_GET['query'] : '';
$search_query = '%' . $query . '%';

// Search in products table with correct column names
$sql = "SELECT * FROM tblproduct WHERE 
        pname LIKE ? OR 
        pprice LIKE ? OR 
        pcategory LIKE ?";
$stmt = $config->prepare($sql);
$stmt->bind_param("sss", $search_query, $search_query, $search_query);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Search Results for "<?php echo htmlspecialchars($query); ?>"</h1>
    
    <?php if ($result->num_rows > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <a href="product_details.php?id=<?php echo $row['id']; ?>">
                        <img src="<?php echo $row['image']; ?>" 
                             alt="<?php echo htmlspecialchars($row['pname']); ?>" 
                             class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                <?php echo htmlspecialchars($row['pname']); ?>
                            </h3>
                            <p class="text-indigo-600 font-bold">₹<?php echo number_format($row['pprice'], 2); ?></p>
                            <p class="text-gray-600 text-sm mt-2">
                                <?php echo htmlspecialchars($row['pcategory']); ?>
                            </p>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-12">
            <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-700 mb-2">No products found</h2>
            <p class="text-gray-500">Try different keywords or browse our categories</p>
        </div>
    <?php endif; ?>
</div>

