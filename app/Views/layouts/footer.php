       <script src="<?= base_url('assets/js/vendor-all.min.js') ?>"></script>
       <script src="<?= base_url('assets/js/plugins/bootstrap.min.js') ?>"></script>
       <script src="<?= base_url('assets/js/pcoded.min.js') ?>"></script>
       <script src="<?= base_url('assets/js/plugins/prism.js') ?>"></script>
       <script src="<?= base_url('js/sweetalert.min.js') ?>"></script>
       <script src="<?= base_url('js/datatables.min.js') ?>"></script>
       <script src="<?= base_url('js/dropify.min.js') ?>"></script>
       <script src="<?= base_url('js/myscritp.js') ?>"></script>
       <script src="<?= base_url('js/select2.min.js') ?>"></script>
       <?= $this->include('components/flash') ?>
       <?= $this->renderSection('script'); ?>
       <!-- <script>
            // <![CDATA[  <-- For SVG support
            if ('WebSocket' in window) {
                (function() {
                    function refreshCSS() {
                        var sheets = [].slice.call(document.getElementsByTagName("link"));
                        var head = document.getElementsByTagName("head")[0];
                        for (var i = 0; i < sheets.length; ++i) {
                            var elem = sheets[i];
                            var parent = elem.parentElement || head;
                            parent.removeChild(elem);
                            var rel = elem.rel;
                            if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                                var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                                elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                            }
                            parent.appendChild(elem);
                        }
                    }
                    var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                    var address = protocol + window.location.host + window.location.pathname + '/ws';
                    var socket = new WebSocket(address);
                    socket.onmessage = function(msg) {
                        if (msg.data == 'reload') window.location.reload();
                        else if (msg.data == 'refreshcss') refreshCSS();
                    };
                    if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                        console.log('Live reload enabled.');
                        sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                    }
                })();
            } else {
                console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
            }
            // ]]>
        </script> -->
       </body>

       </html>