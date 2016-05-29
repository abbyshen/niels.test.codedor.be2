<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo h($newsitem['Newsitem']['title']); ?></h1>

<p><small>Created: <?php echo $newsitem['Newsitem']['created']; ?></small></p>

<p><?php echo h($newsitem['Newsitem']['body']); ?></p>