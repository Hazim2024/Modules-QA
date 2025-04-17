<?php if (isset($_SESSION['username'])): ?>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
<?php endif; ?>

<footer>
        <div class="container">
            <div class="content">
                <div class="left">
                    <div class="title">LJMU Module Q&A</div>
                    <p>An interactive way of tracking your budget</p>
                </div>
            </div>
            <div class="copyright">
                <p>Designed by Hazim Iftikhar © 2025</p>
                <div class="socials">
                    <a href="https://github.com/Hazim2024" target="_blank"><ion-icon name="logo-github"></ion-icon></a>
                    <a href="https://www.linkedin.com/in/hazim-iftikhar/" target="_blank"><ion-icon name="logo-linkedin"></ion-icon></a>
                    <a href="mailto:hazimiftikhar@gmail.com" target="_blank"><ion-icon name="mail"></ion-icon></a>
                </div>
            </div>
        </div>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
