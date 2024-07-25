<footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="welcome.html">Welcome</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <p>Email: support@library.com</p>
                <p>Phone: +1 234 567 890</p>
                <p>Address: 123 Library St, Booktown</p>
            </div>
            <div class="footer-column">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#"><img src="./img/Facebook Icon Social Media PNG & SVG Design For T-Shirts.jpg" alt="Facebook"></a>
                    <a href="#"><img src="./img/Premium PSD _ Social media icon twitter 3d.jpg" alt="Twitter"></a>
                    <a href="#"><img src="./img/Instagram PNG - Free Download.jpg" alt="Instagram"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Library Book Lending System. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('table').DataTable({
            order: [0, 'desc']
        });
    });

    function myFunction() {
        confirm("Are you sure?");
    }
</script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>