<?php
$title = "Upload Anime Character";
require_once('private/authentication.php');
$introduction = "This Page can be used to add a new anime character into our database alone with an image.";
include 'includes/header.php';
include 'includes/upload.php';
require_login();
?>

<section class="row justify-content-center my-5 container mx-auto">
    <div class="col-md-6">
        <!-- Error Message -->
        <?php if ($message != ""): ?>
            <div class="alert alert-secondary my-3" role="alert">
                <?= $message; ?>
            </div>
        <?php endif ?>

        <!-- Upload Form -->
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <!-- Character Name -->
            <div class="mb-3">
                <label for="character_name" class="form-label">Character Name</label>
                <input type="text" name="character_name" id="character_name" class="form-control" required>
            </div>
            <!-- Anime -->
            <div class="mb-3">
                <label for="anime" class="form-label">Anime</label>
                <input type="text" name="anime" id="anime" class="form-control" required>
            </div>
            <!-- Total Episodes -->
            <div class="mb-3">
                <label for="total_episodes" class="form-label">Total Episodes</label>
                <input type="number" name="total_episodes" id="total_episodes" class="form-control">
            </div>
            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <!-- Personality Type -->
            <div class="mb-3">
                <label for="personality_type" class="form-label">Personality Type</label>
                <input type="text" name="personality_type" id="personality_type" class="form-control">
            </div>
            <!-- Genre -->
            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <select name="genre" id="genre" class="form-select">
                    <option value="Shonen">Shonen</option>
                    <option value="Shojo">Shojo</option>
                    <option value="Seinen">Seinen</option>
                    <option value="Josei">Josei</option>
                    <option value="Isekai">Isekai</option>
                    <option value="Slice of Life">Slice of Life</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Adventure">Adventure</option>
                    <option value="Romance">Romance</option>
                    <option value="Horror">Horror</option>
                </select>
            </div>
            <!-- Genre -->
            <div class="mb-3">
                <label for="genre_2" class="form-label">Genre 2</label>
                <select name="genre_2" id="genre_2" class="form-select">
                    <option value="Shonen">Shonen</option>
                    <option value="Shojo">Shojo</option>
                    <option value="Seinen">Seinen</option>
                    <option value="Josei">Josei</option>
                    <option value="Isekai">Isekai</option>
                    <option value="Slice of Life">Slice of Life</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Adventure">Adventure</option>
                    <option value="Romance">Romance</option>
                    <option value="Horror">Horror</option>
                </select>
            </div>
            <!-- Year of Release -->
            <div class="mb-3">
                <label for="year_of_release" class="form-label">Year of Release</label>
                <input type="number" name="year_of_release" id="year_of_release" class="form-control" min="1900"
                    max="<?= date('Y'); ?>">
            </div>
            <!-- Voice Actor -->
            <div class="mb-3">
                <label for="voice_actor" class="form-label">Voice Actor</label>
                <input type="text" name="voice_actor" id="voice_actor" class="form-control">
            </div>
            <!-- Popularity Rating -->
            <div class="mb-3">
                <label for="popularity_rating" class="form-label">Popularity Rating</label>
                <input type="number" name="popularity_rating" id="popularity_rating" class="form-control">
            </div>
            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image_file" class="form-label">Upload Image</label>
                <input type="file" name="image_file" id="image_file" class="form-control"
                    accept=".jpg, .jpeg, .png, .webp" required>
            </div>
            <!-- Image URL -->
            <div class="mb-3">
                <label for="image_url_src" class="form-label">Image URL src</label>
                <input type="url" name="image_url_src" id="image_url_src" class="form-control"
                    value="<?php echo $image_url_src; ?>">
            </div>
            <!-- Submit Button -->
            <button type="submit" name="submit" class="btn btn-primary" value="submit">Upload Character</button>
        </form>

    </div>
</section>
<?php include 'includes/footer.php'; ?>