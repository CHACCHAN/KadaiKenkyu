@extends('Home.CreaterTool.creatertool')
@section('view')
<body onload="resizeCanvas();">
    {{-- 入力コンテンツ --}}
    <form method="POST" action="#posted" class="form-horizontal" onsubmit="draw(); return false;" onreset="return onReset();">
        <div class="row">
            {{-- 入力欄 --}}
            <div class="col-12 mt-3 pe-4">
                <div class="h4">原稿を入力する</div>
                <textarea id="str" name="str" rows="10" wrap="soft" class="form-control" placeholder="描画する文字列を入力してください" oninput="onChangeText()"></textarea>
                {{-- ページ数 --}}
                <div class="text-end">
                    <small id="pages" class="text-muted"></small>
                </div>
            </div>
            {{-- コマンドメニュー --}}
            <div class="col-12 mt-3 pe-4">
                <div class="h4">コマンドメニュー</div>
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#CollapseMenu" aria-expanded="false" aria-controls="CollapseMenu">
                    メニューを展開する
                </button>
                <div id="CollapseMenu" class="collapse my-1">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-light" onclick="PrintOut();">プリントアウト</button>
                            <button type="reset" class="btn btn-light">リセット</button>
                            {{-- オプション --}}
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#OptionModal">オプション</button>
                            <div class="modal fade" id="OptionModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- 原稿設定 --}}
                                            <div class="h4">原稿の設定</div>
                                            <div class="input-group mb-1">
                                                <div class="input-group-text">
                                                    <input type="checkbox" id="indent-beginning" class="form-check-input mt-0" checked onclick="changeOption()">
                                                </div>
                                                <div class="form-control">
                                                    行頭を字下げする（句点後の改行時のみ）
                                                </div>
                                            </div>
                                            <div class="input-group mb-1">
                                                <div class="input-group-text">
                                                    <input type="checkbox" id="number-to-kanji" class="form-check-input mt-0" onclick="changeOption()">
                                                </div>
                                                <div class="form-control">
                                                    数字を漢数字に変換する
                                                </div>
                                            </div>
                                            <div class="input-group mb-1">
                                                <div class="input-group-text">
                                                    <input type="checkbox" id="noma-top-convert" class="form-check-input mt-0" onclick="changeOption()">
                                                </div>
                                                <div class="form-control">
                                                    行頭の「々」を直前の字に変換する
                                                </div>
                                            </div>
                                            <div class="input-group mb-1">
                                                <div class="input-group-text">
                                                    <input type="checkbox" id="cell-in-2half" class="form-check-input mt-0" onclick="changeOption()">
                                                </div>
                                                <div class="form-control">
                                                    半角文字は横向きにして1マスに2文字描画する
                                                </div>
                                            </div>
                                            <div class="row mb-3 ms-1">
                                                <div class="col-auto p-0">
                                                    <input type="color" id="line-color" class="form-control form-control-color border-0" value="#c48080" onchange="changeOption()">
                                                </div>
                                                <div class="col-auto p-0">
                                                    <div class="fs-6 mt-2">
                                                        罫線の色を変更する
                                                    </div>
                                                </div>
                                            </div>
                    
                                            {{-- 行末処理 --}}
                                            <div class="h4">行末の記号処理</div>
                                            <div class="input-group mb-1">
                                                <div class="input-group-text">
                                                    <input type="radio" id="put-into-one-cell" class="form-check-input mt-0" name="end-of-line-process" checked onclick="changeOption()">
                                                </div>
                                                <div class="form-control">
                                                    最後の枠の中に収める
                                                </div>
                                            </div>
                                            <div class="input-group mb-1">
                                                <div class="input-group-text">
                                                    <input type="radio" id="put-outside" class="form-check-input mt-0" name="end-of-line-process" onclick="changeOption()">
                                                </div>
                                                <div class="form-control">
                                                    枠の外に配置する
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <input type="radio" id="put-next-line" class="form-check-input mt-0" name="end-of-line-process" onclick="changeOption()">
                                                </div>
                                                <div class="form-control">
                                                    次の行に配置する
                                                </div>
                                            </div>
                    
                                            {{-- リセット --}}
                                            <div class="text-end">
                                                <button type="button" class="btn btn-secondary" onclick="resetOption()">リセット</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- ヘルプ --}}
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#HelpModal">使い方</button>
                            <div class="modal fade" id="HelpModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="h2">使い方</div>
                                            <div class="h4 text-secondary">概要</div>
                                            <div class="fs-6">テキストボックス内に文字を入力すると、リアルタイムに原稿用紙が描画されます。</div>
                                            <div class="fs-6">入力後は、プリントアウト用にフォーマットされたデータを出力できます。</div>
                                            <div class="fs-6">入力した文字列は外部には一切出力されません。</div>
                                            <br>
                                            <div class="h4 text-secondary">オプションの説明</div>
                                            <div class="fs-6">原稿用紙の設定はコマンドメニューの「メニューを展開する」ボタンから変更できます。</div>
                                            <br>
                                            <div class="d-flex">
                                                <div class="flex-fill ad-left-content">
                                                    <dl>
                                                        <dt>行頭を字下げする（句点後の改行時のみ</dt>
                                                        <dd>
                                                            チェックをつけると、前の行末が句点「。」の場合、次の行の先頭を1文字分、字下げします。<br>
                                                            チェックをはずすと、行の先頭の字下げは行いません。
                                                        </dd>
                                                        <dt>数字を漢数字に変換する</dt>
                                                        <dd>
                                                            チェックをつけると、半角数字と全角数字（アラビア数字のみ）は漢数字に変換して描画します。<br>
                                                            チェックをはずすと、漢数字への変換は行いません。
                                                        </dd>
                                                        <dt>行頭の「々」を直前の字に変換する</dt>
                                                        <dd>
                                                            チェックをつけると、行頭に来た「々」記号を、直前の文字に変換して描画します。<br>
                                                            チェックをはずすと、「々」の変換は行いません。
                                                        </dd>
                                                        <dt>半角文字は横向きにして1マスに2文字描画する</dt>
                                                        <dd>
                                                            チェックをつけると、半角文字は90度回転し、1マスに2文字描画します。<br>
                                                            チェックをはずすと、半角文字も全角文字と同様、回転せず、1文字を1マスに描画します。
                                                        </dd>
                                                        <dt>行末の記号の処理</dt>
                                                        <dd>
                                                            行末に句読点や鍵かっこなどの記号が来た場合の描画方法を指定します。
                                                            <dl>
                                                                <dt>最後の枠の中に収める</dt>
                                                                <dd>最後の文字と記号を1つのマスに描画します。</dd>
                                                                <dt>枠の外に配置する</dt>
                                                                <dd>罫線の外に記号を描画します。</dd>
                                                                <dt>次の行に配置する</dt>
                                                                <dd>次の行頭に描画します。</dd>
                                                            </dl>
                                                        </dd>
                                                        <dt>罫線の色</dt>
                                                        <dd>罫線の色を変更できます。</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        function PrintOut() {
                          const OutputContent = document.getElementById('ImageContent');
                          const canvasImage = document.querySelector('canvas').toDataURL('image/png', 300);
                          const html = "<img src="${canvasImage}">";
                          OutputContent.src = html;
                        }
                    </script>

                    <iframe src="<p>あいうえお</p>" id="ImageContent" frameborder="1"></iframe>
                      <div>ここはiframeの外です</div>
                      <button id="print-btn">印刷</button>
                      <script>
                      document.getElementById('print-btn').addEventListener('click',()=>{
                        document.getElementById('ImageContent').contentWindow.print();
                      });
                    </script>
                </div>
            </div>
        </div>
    </form>

    {{-- 原稿本体 --}}
    <div class="d-flex">
        <div class="flex-fill ad-left-content manuscript-area">
            <div id="manuscript" class="col-sm-12"></div>
        </div>
    </div>
</body>
@endsection
@section('jQuery')
<script type="text/javascript">
    window.fluxtag = {
      readyBids: {
        prebid: false,
        amazon: false,
        google: false
      },
      failSafeTimeout: 3e3,
      isFn: function isFn(object) {
        var _t = 'Function';
        var toString = Object.prototype.toString;
        return toString.call(object) === '[object ' + _t + ']';
      },
      launchAdServer: function() {
        if (!fluxtag.readyBids.prebid || !fluxtag.readyBids.amazon) {
          return;
        }
        fluxtag.requestAdServer();
      },
      requestAdServer: function() {
        if (!fluxtag.readyBids.google) {
          fluxtag.readyBids.google = true;
          googletag.cmd.push(function () {
            if (!!(pbjs.setTargetingForGPTAsync) && fluxtag.isFn(pbjs.setTargetingForGPTAsync)) {
              pbjs.que.push(function () {
                pbjs.setTargetingForGPTAsync();
              });
            }
            googletag.pubads().refresh();
          });
        }
      }
    };
</script>
<script type="text/javascript">
    var imobile_gam_slots = [];
    googletag.cmd.push(function() {
      var PC_728x90 = googletag.sizeMapping()
      .addSize([770, 0], [728, 90])
      .addSize([0, 0], [])
      .build();
      var PC_300x600 = googletag.sizeMapping()
      .addSize([770, 0], [300, 600])
      .addSize([0, 0], [])
      .build();
      var PC_rect = googletag.sizeMapping()
      .addSize([770, 0], [[336, 280], [300, 250]])
      .addSize([0, 0], [])
      .build();
      var SP_rect = googletag.sizeMapping()
      .addSize([770, 0], [])
      .addSize([0, 0], [[300, 250], [336, 280]])
      .build();
      var SP_320x50 = googletag.sizeMapping()
      .addSize([770, 0], [])
      .addSize([0, 0], [320, 50])
      .build();
      imobile_gam_slots.push(googletag.defineSlot('/9176203,22527524311/1708075', [728, 90], 'div-gpt-ad-1593164128223-0').defineSizeMapping(PC_728x90).addService(googletag.pubads()));
      imobile_gam_slots.push(googletag.defineSlot('/9176203,22527524311/1708076', [300, 600], 'div-gpt-ad-1593164164007-0').defineSizeMapping(PC_300x600).addService(googletag.pubads()));
      imobile_gam_slots.push(googletag.defineSlot('/9176203,22527524311/1708077', [[336, 280], [300, 250]], 'div-gpt-ad-1593164199519-0').defineSizeMapping(PC_rect).addService(googletag.pubads()));
      imobile_gam_slots.push(googletag.defineSlot('/9176203,22527524311/1708078', [[336, 280], [300, 250]], 'div-gpt-ad-1593164233998-0').defineSizeMapping(PC_rect).addService(googletag.pubads()));
      imobile_gam_slots.push(googletag.defineSlot('/9176203,22527524311/1715781', [728, 90], 'div-gpt-ad-1598864110380-0').defineSizeMapping(PC_728x90).addService(googletag.pubads()));
      imobile_gam_slots.push(googletag.defineSlot('/9176203,22527524311/1708080', [[300, 250], [336, 280]], 'div-gpt-ad-1593164302694-0').defineSizeMapping(SP_rect).addService(googletag.pubads()));
      imobile_gam_slots.push(googletag.defineSlot('/9176203,22527524311/1708081', [[336, 280], [300, 250]], 'div-gpt-ad-1593164338660-0').defineSizeMapping(SP_rect).addService(googletag.pubads()));
      imobile_gam_slots.push(googletag.defineSlot('/9176203,22527524311/1709109', [320, 50], 'div-gpt-ad-1593756307145-0').defineSizeMapping(SP_320x50).addService(googletag.pubads()));
      googletag.pubads().enableSingleRequest();
      googletag.pubads().collapseEmptyDivs();
      googletag.pubads().disableInitialLoad();
      googletag.enableServices();
  
      if (!!(window.pbFlux) && !!(window.pbFlux.prebidBidder) && fluxtag.isFn(window.pbFlux.prebidBidder)) {
        pbjs.que.push(function () {
          window.pbFlux.prebidBidder();
        });
      } else {
        fluxtag.readyBids.prebid = true;
        fluxtag.launchAdServer();
      }
    });
</script>
<script type="text/javascript">
    ! function (a9, a, p, s, t, A, g) {
      if (a[a9]) return;
  
      function q(c, r) {
        a[a9]._Q.push([c, r])
      }
      a[a9] = {
        init: function () {
          q("i", arguments)
        },
        fetchBids: function () {
          q("f", arguments)
        },
        setDisplayBids: function () {},
        targetingKeys: function () {
          return []
        },
        _Q: []
      };
      A = p.createElement(s);
      A.async = !0;
      A.src = t;
      g = p.getElementsByTagName(s)[0];
      g.parentNode.insertBefore(A, g)
    }("apstag", window, document, "script", "//c.amazon-adsystem.com/aax2/apstag.js");
    apstag.init({
      pubID: 'c06cc614-f284-4373-8e7b-e334e4dcb9d3',
      adServer: 'googletag',
      bidTimeout: 1e3,
      schain: {
        complete: 1,
        ver: '1.0',
        nodes: [{
          asi: 'i-mobile.co.jp',
          sid: '73264',
          hp: 1,
        }]
      }
    });
  
    googletag.cmd.push(function () {
      apstag.fetchBids({
        slots:  [
          {
            slotID: 'div-gpt-ad-1593164128223-0',
            slotName: '/9176203/1708075',
            sizes: [[728, 90]]
          },
          {
            slotID: 'div-gpt-ad-1593164164007-0',
            slotName: '/9176203/1708076',
            sizes: [[300, 600]]
          },
          {
            slotID: 'div-gpt-ad-1593164199519-0',
            slotName: '/9176203/1708077',
            sizes: [[300, 250], [336, 280]]
          },
          {
            slotID: 'div-gpt-ad-1593164233998-0',
            slotName: '/9176203/1708078',
            sizes: [[300, 250], [336, 280]]
          },
          {
            slotID: 'div-gpt-ad-1598864110380-0',
            slotName: '/9176203/1715781',
            sizes: [[728, 90]]
          },
          {
            slotID: 'div-gpt-ad-1593164302694-0',
            slotName: '/9176203/1708080',
            sizes: [[300, 250], [336, 280]]
          },
          {
            slotID: 'div-gpt-ad-1593164338660-0',
            slotName: '/9176203/1708081',
            sizes: [[300, 250], [336, 280]]
          },
          {
            slotID: 'div-gpt-ad-1593756307145-0',
            slotName: '/9176203/1709109',
            sizes: [[320, 50]]
          }]
      }, function (bids) {
        googletag.cmd.push(function () {
          apstag.setDisplayBids();
          fluxtag.readyBids.amazon = true;
          fluxtag.launchAdServer();
        });
      });
    });
</script>
<script type="text/javascript">
    var _0xff7b=["\x23\x63\x34\x38\x30\x38\x30","\x72\x67\x62\x28\x30\x2C\x20\x30\x2C\x20\x30\x29","\u3001","\u3002","\u300C","\u300D","\x2D","\x28","\x29","\x5B","\x5D","\x7B","\x7D","\x3C","\x3E","\u30FC","\uFF1A","\u2026","\u2500","\uFF0D","\u2010","\u2015","\uFF5E","\uFF1D","\uFF08","\uFF09","\uFF1C","\uFF1E","\uFF5B","\uFF5D","\u300E","\u300F","\u3010","\u3011","\uFF3B","\uFF3D","\u300A","\u300B","\u226A","\u226B","\u3014","\u3015","\u3041","\u3043","\u3045","\u3047","\u3049","\u3063","\u3083","\u3085","\u3087","\u308E","\u30A1","\u30A3","\u30A5","\u30A7","\u30A9","\u30C3","\u30E3","\u30E5","\u30E7","\u30EE","\x5F\x76\x65\x72\x73\x69\x6F\x6E","\x5F\x69\x6E\x64\x65\x6E\x74\x42\x65\x67\x69\x6E\x6E\x69\x6E\x67","\x5F\x63\x65\x6C\x6C\x49\x6E\x32\x48\x61\x6C\x66","\x5F\x6E\x75\x6D\x62\x65\x72\x54\x6F\x4B\x61\x6E\x6A\x69","\x5F\x6E\x6F\x6D\x61\x54\x6F\x70\x43\x6F\x6E\x76\x65\x72\x74","\x5F\x6C\x69\x6E\x65\x45\x6E\x64\x53\x79\x6D\x62\x6F\x6C","\x5F\x6C\x69\x6E\x65\x43\x6F\x6C\x6F\x72","\x6D\x61\x6E\x75\x73\x63\x72\x69\x70\x74\x44\x72\x61\x77\x4F\x70\x74\x69\x6F\x6E","\x67\x65\x74\x49\x74\x65\x6D","\x70\x61\x72\x73\x65","\x73\x74\x72\x69\x6E\x67\x69\x66\x79","\x73\x65\x74\x49\x74\x65\x6D","\x5F\x70\x61\x67\x65\x73","\x6D\x61\x6E\x75\x73\x63\x72\x69\x70\x74\x54\x65\x78\x74","","\u524D\u56DE\u5165\u529B\u3057\u305F\u539F\u7A3F\u3092\u5FA9\u5143\u3057\u307E\u3059\u304B\uFF1F","\x76\x61\x6C\x75\x65","\x73\x74\x72","\x67\x65\x74\x45\x6C\x65\x6D\x65\x6E\x74\x42\x79\x49\x64","\u539F\u7A3F\u6B04\u306B\u5165\u529B\u3057\u305F\u5185\u5BB9\u3092\u6D88\u3057\u3066\u3082\u3088\u308D\u3057\u3044\u3067\u3059\u304B\uFF1F\u6D88\u3059\u3068\u5FA9\u5143\u3067\u304D\u307E\u305B\u3093\u3002","\x73\x65\x74\x44\x72\x61\x77\x4F\x70\x74\x69\x6F\x6E","\x69\x6E\x64\x65\x6E\x74\x42\x65\x67\x69\x6E\x6E\x69\x6E\x67","\x63\x68\x65\x63\x6B\x65\x64","\x69\x6E\x64\x65\x6E\x74\x2D\x62\x65\x67\x69\x6E\x6E\x69\x6E\x67","\x63\x65\x6C\x6C\x49\x6E\x32\x48\x61\x6C\x66","\x63\x65\x6C\x6C\x2D\x69\x6E\x2D\x32\x68\x61\x6C\x66","\x6E\x75\x6D\x62\x65\x72\x54\x6F\x4B\x61\x6E\x6A\x69","\x6E\x75\x6D\x62\x65\x72\x2D\x74\x6F\x2D\x6B\x61\x6E\x6A\x69","\x6E\x6F\x6D\x61\x54\x6F\x70\x43\x6F\x6E\x76\x65\x72\x74","\x6E\x6F\x6D\x61\x2D\x74\x6F\x70\x2D\x63\x6F\x6E\x76\x65\x72\x74","\x70\x75\x74\x2D\x69\x6E\x74\x6F\x2D\x6F\x6E\x65\x2D\x63\x65\x6C\x6C","\x6C\x69\x6E\x65\x45\x6E\x64\x53\x79\x6D\x62\x6F\x6C","\x70\x75\x74\x2D\x6F\x75\x74\x73\x69\x64\x65","\x70\x75\x74\x2D\x6E\x65\x78\x74\x2D\x6C\x69\x6E\x65","\x6C\x69\x6E\x65\x43\x6F\x6C\x6F\x72","\x6C\x69\x6E\x65\x2D\x63\x6F\x6C\x6F\x72","\x67\x65\x74\x44\x72\x61\x77\x4F\x70\x74\x69\x6F\x6E","\x73\x61\x76\x65","\x64\x72\x61\x77","\x69\x6E\x6E\x65\x72\x54\x65\x78\x74","\x70\x61\x67\x65\x73","\u539F\u7A3F\u7528\u7D19\x20","\u679A","\x2E\x2F\x6D\x61\x6E\x75\x73\x63\x72\x69\x70\x74\x2D\x66\x6F\x72\x2D\x70\x72\x69\x6E\x74\x2E\x68\x74\x6D\x6C","\x6D\x61\x6E\x75\x73\x63\x72\x69\x70\x74\x46\x6F\x72\x50\x72\x69\x6E\x74","\x6F\x70\x65\x6E","\x68\x69\x64\x64\x65\x6E\x2D\x61\x72\x65\x61","\x64\x6F\x63\x75\x6D\x65\x6E\x74","\x70\x72\x69\x6E\x74\x2D\x61\x72\x65\x61","\x67\x65\x74\x54\x65\x78\x74","\x69\x6D\x67","\x63\x72\x65\x61\x74\x65\x45\x6C\x65\x6D\x65\x6E\x74","\x73\x72\x63","\x73\x65\x74\x41\x74\x74\x72\x69\x62\x75\x74\x65","\x61\x70\x70\x65\x6E\x64\x43\x68\x69\x6C\x64","\x66\x6F\x72\x45\x61\x63\x68","\x67\x65\x74\x49\x6D\x61\x67\x65\x73","\x70\x72\x69\x6E\x74","\x66\x69\x72\x73\x74\x43\x68\x69\x6C\x64","\x72\x65\x6D\x6F\x76\x65\x43\x68\x69\x6C\x64","\x70\x61\x72\x65\x6E\x74\x45\x6C\x65\x6D\x65\x6E\x74","\x63\x61\x6E\x76\x61\x73\x57\x69\x64\x74\x68","\x63\x61\x6E\x76\x61\x73\x48\x65\x69\x67\x68\x74","\x6D\x61\x6E\x75\x73\x63\x72\x69\x70\x74\x50\x61\x67\x65\x73","\x74\x65\x78\x74","\x64\x72\x61\x77\x4F\x70\x74\x69\x6F\x6E","\x6C\x65\x6E\x67\x74\x68","\x20","\u3007","\u4E00","\u4E8C","\u4E09","\u56DB","\u4E94","\u516D","\u4E03","\u516B","\u4E5D","\x72\x65\x70\x6C\x61\x63\x65","\x69\x6E\x64\x65\x78","\x64\x72\x61\x77\x54\x65\x78\x74","\x70\x6F\x70","\x64\x65\x73\x74\x72\x6F\x79","\x63\x61\x6E\x76\x61\x73","\x77\x69\x64\x74\x68","\x6D\x61\x78","\x70\x75\x73\x68","\x67\x65\x74\x49\x6D\x61\x67\x65","\x6D\x61\x70","\x63\x6C\x69\x65\x6E\x74\x57\x69\x64\x74\x68","\x5F\x69\x6E\x64\x65\x78","\x5F\x70\x72\x65\x76\x43\x68\x61\x72","\x6C\x69\x6E\x65\x73","\x63\x68\x61\x72\x73","\x63\x6F\x6E\x74\x65\x78\x74","\x32\x64","\x67\x65\x74\x43\x6F\x6E\x74\x65\x78\x74","\x63\x65\x6C\x6C\x53\x69\x7A\x65","\x66\x6F\x6E\x74\x53\x69\x7A\x65","\x6C\x69\x6E\x65\x49\x6E\x74\x65\x72\x76\x61\x6C\x57\x69\x64\x74\x68","\x64\x72\x61\x77\x57\x69\x64\x74\x68","\x64\x72\x61\x77\x48\x65\x69\x67\x68\x74","\x68\x65\x69\x67\x68\x74","\x63\x65\x69\x6C","\x64\x72\x61\x77\x4D\x61\x72\x67\x69\x6E\x58","\x64\x72\x61\x77\x4D\x61\x72\x67\x69\x6E\x59","\x66\x6C\x6F\x6F\x72","\x67\x65\x74\x43\x65\x6C\x6C\x52\x65\x63\x74\x42\x79\x4C\x69\x6E\x65\x41\x6E\x64\x43\x68\x61\x72\x49\x6E\x64\x65\x78","\x63\x6C\x65\x61\x72\x52\x65\x63\x74","\x73\x74\x72\x6F\x6B\x65\x53\x74\x79\x6C\x65","\x6C\x69\x6E\x65\x57\x69\x64\x74\x68","\x6C\x65\x66\x74","\x74\x6F\x70","\x72\x69\x67\x68\x74","\x62\x6F\x74\x74\x6F\x6D","\x73\x74\x72\x6F\x6B\x65\x52\x65\x63\x74","\x62\x65\x67\x69\x6E\x50\x61\x74\x68","\x6D\x6F\x76\x65\x54\x6F","\x6C\x69\x6E\x65\x54\x6F","\x73\x74\x72\x6F\x6B\x65","\x66\x69\x6C\x6C\x53\x74\x79\x6C\x65","\x61\x72\x63\x54\x6F","\x66\x69\x6C\x6C","\x66\x69\x6C\x6C\x52\x65\x63\x74","\x64\x72\x61\x77\x47\x72\x69\x64","\x66\x6F\x6E\x74","\x70\x78\x20\x73\x65\x72\x69\x66","\x70\x72\x65\x76\x43\x68\x61\x72","\x67\x65\x74\x43\x68\x61\x72","\x0A","\x69\x73\x53\x70\x61\x63\x65","\x69\x73\x48\x61\x6C\x66","\x63\x68\x61\x72\x41\x74","\u3005","\x68\x61\x73","\x50\x49","\x70\x78\x20\x6D\x6F\x6E\x6F\x73\x70\x61\x63\x65","\x6D\x65\x61\x73\x75\x72\x65\x54\x65\x78\x74","\x74\x72\x61\x6E\x73\x6C\x61\x74\x65","\x72\x6F\x74\x61\x74\x65","\x66\x69\x6C\x6C\x54\x65\x78\x74","\x72\x65\x73\x74\x6F\x72\x65","\x63\x68\x61\x72\x43\x6F\x64\x65\x41\x74","\x09","\u3000","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x69\x6D\x61\x67\x65\x2F\x70\x6E\x67","\x74\x6F\x44\x61\x74\x61\x55\x52\x4C","\x72\x65\x6D\x6F\x76\x65","\x6C\x6F\x61\x64","\x6D\x61\x6E\x75\x73\x63\x72\x69\x70\x74","\x72\x65\x73\x69\x7A\x65","\x61\x64\x64\x45\x76\x65\x6E\x74\x4C\x69\x73\x74\x65\x6E\x65\x72"];const OUTER_LINE_WIDTH=2;const OUTER_LINE_MARGIN=3;const DEFAULT_LINE_COLOR=_0xff7b[0];const TEXT_COLOR=_0xff7b[1];const JAPANESE_COMMA=_0xff7b[2];const JAPANESE_PERIOD=_0xff7b[3];const JAPANESE_BRACKET_START=_0xff7b[4];const JAPANESE_BRACKET_END=_0xff7b[5];const ROTATE_CHARS= new Set([_0xff7b[6],_0xff7b[7],_0xff7b[8],_0xff7b[9],_0xff7b[10],_0xff7b[11],_0xff7b[12],_0xff7b[13],_0xff7b[14],_0xff7b[15],_0xff7b[16],_0xff7b[17],,_0xff7b[18],_0xff7b[19],_0xff7b[20],_0xff7b[21],_0xff7b[22],_0xff7b[23],_0xff7b[24],_0xff7b[25],_0xff7b[26],_0xff7b[27],_0xff7b[28],_0xff7b[29],_0xff7b[4],_0xff7b[5],_0xff7b[30],_0xff7b[31],_0xff7b[32],_0xff7b[33],_0xff7b[34],_0xff7b[35],_0xff7b[36],_0xff7b[37],_0xff7b[38],_0xff7b[39],_0xff7b[40],_0xff7b[41]]);const UPPER_RIGHT_MARK= new Set([_0xff7b[2],_0xff7b[3]]);const UPPER_RIGHT_CHARS= new Set([_0xff7b[42],_0xff7b[43],_0xff7b[44],_0xff7b[45],_0xff7b[46],_0xff7b[47],_0xff7b[48],_0xff7b[49],_0xff7b[50],_0xff7b[51],_0xff7b[52],_0xff7b[53],_0xff7b[54],_0xff7b[55],_0xff7b[56],_0xff7b[57],_0xff7b[58],_0xff7b[59],_0xff7b[60],_0xff7b[61]]);const LINE_END_SYMBOL_PUT_INTO_ONE_CELL=1;const LINE_END_SYMBOL_PUT_OUTSIDE=2;const LINE_END_SYMBOL_PUT_NEXT_LINE=3;class DrawOption{constructor(){this[_0xff7b[62]]= 1;this[_0xff7b[63]]= true;this[_0xff7b[64]]= false;this[_0xff7b[65]]= false;this[_0xff7b[66]]= false;this[_0xff7b[67]]= LINE_END_SYMBOL_PUT_INTO_ONE_CELL;this[_0xff7b[68]]= DEFAULT_LINE_COLOR}static load(){const _0x6cfcx11=localStorage[_0xff7b[70]](_0xff7b[69]);const _0x6cfcx12= new DrawOption();if(_0x6cfcx11){const _0x6cfcx13=JSON[_0xff7b[71]](_0x6cfcx11);if(_0x6cfcx13[_0xff7b[63]]!== undefined){_0x6cfcx12[_0xff7b[63]]= _0x6cfcx13[_0xff7b[63]]};if(_0x6cfcx13[_0xff7b[64]]!== undefined){_0x6cfcx12[_0xff7b[64]]= _0x6cfcx13[_0xff7b[64]]};if(_0x6cfcx13[_0xff7b[65]]!== undefined){_0x6cfcx12[_0xff7b[65]]= _0x6cfcx13[_0xff7b[65]]};if(_0x6cfcx13[_0xff7b[66]]!== undefined){_0x6cfcx12[_0xff7b[66]]= _0x6cfcx13[_0xff7b[66]]};if(_0x6cfcx13[_0xff7b[67]]!== undefined){_0x6cfcx12[_0xff7b[67]]= _0x6cfcx13[_0xff7b[67]]};if(_0x6cfcx13[_0xff7b[68]]!== undefined){_0x6cfcx12[_0xff7b[68]]= _0x6cfcx13[_0xff7b[68]]}};return _0x6cfcx12}save(){localStorage[_0xff7b[73]](_0xff7b[69],JSON[_0xff7b[72]](this))}set indentBeginning(_0x6cfcx16){this[_0xff7b[63]]= _0x6cfcx16}get indentBeginning(){return this[_0xff7b[63]]}set cellIn2Half(_0x6cfcx16){this[_0xff7b[64]]= _0x6cfcx16}get cellIn2Half(){return this[_0xff7b[64]]}set numberToKanji(_0x6cfcx16){this[_0xff7b[65]]= _0x6cfcx16}get numberToKanji(){return this[_0xff7b[65]]}set nomaTopConvert(_0x6cfcx16){this[_0xff7b[66]]= _0x6cfcx16}get nomaTopConvert(){return this[_0xff7b[66]]}set lineEndSymbol(_0x6cfcx16){this[_0xff7b[67]]= _0x6cfcx16}get lineEndSymbol(){return this[_0xff7b[67]]}set lineColor(_0x6cfcx16){this[_0xff7b[68]]= _0x6cfcx16}get lineColor(){return this[_0xff7b[68]]}};class DrawResult{constructor(pages){this[_0xff7b[74]]= pages}get pages(){return this[_0xff7b[74]]}};function restoreText(){const _0x6cfcx1e=localStorage[_0xff7b[70]](_0xff7b[75]);if(_0x6cfcx1e!== null&& _0x6cfcx1e!== _0xff7b[76]){if(confirm(_0xff7b[77])){document[_0xff7b[80]](_0xff7b[79])[_0xff7b[78]]= _0x6cfcx1e}}}function onChangeText(){const _0x6cfcx1e=document[_0xff7b[80]](_0xff7b[79])[_0xff7b[78]];localStorage[_0xff7b[73]](_0xff7b[75],_0x6cfcx1e);draw()}function onReset(){if(!confirm(_0xff7b[81])){return false};setTimeout(onChangeText,10);return true}function changeOption(){draw()}function resetOption(){DisplayOption[_0xff7b[82]]( new DrawOption());draw()}class DisplayOption{static getDrawOption(){const _0x6cfcx12= new DrawOption();_0x6cfcx12[_0xff7b[83]]= document[_0xff7b[80]](_0xff7b[85])[_0xff7b[84]];_0x6cfcx12[_0xff7b[86]]= document[_0xff7b[80]](_0xff7b[87])[_0xff7b[84]];_0x6cfcx12[_0xff7b[88]]= document[_0xff7b[80]](_0xff7b[89])[_0xff7b[84]];_0x6cfcx12[_0xff7b[90]]= document[_0xff7b[80]](_0xff7b[91])[_0xff7b[84]];if(document[_0xff7b[80]](_0xff7b[92])[_0xff7b[84]]){_0x6cfcx12[_0xff7b[93]]= LINE_END_SYMBOL_PUT_INTO_ONE_CELL}else {if(document[_0xff7b[80]](_0xff7b[94])[_0xff7b[84]]){_0x6cfcx12[_0xff7b[93]]= LINE_END_SYMBOL_PUT_OUTSIDE}else {if(document[_0xff7b[80]](_0xff7b[95])[_0xff7b[84]]){_0x6cfcx12[_0xff7b[93]]= LINE_END_SYMBOL_PUT_NEXT_LINE}}};_0x6cfcx12[_0xff7b[96]]= document[_0xff7b[80]](_0xff7b[97])[_0xff7b[78]];return _0x6cfcx12}static setDrawOption(_0x6cfcx12){document[_0xff7b[80]](_0xff7b[85])[_0xff7b[84]]= _0x6cfcx12[_0xff7b[83]];document[_0xff7b[80]](_0xff7b[87])[_0xff7b[84]]= _0x6cfcx12[_0xff7b[86]];document[_0xff7b[80]](_0xff7b[89])[_0xff7b[84]]= _0x6cfcx12[_0xff7b[88]];document[_0xff7b[80]](_0xff7b[91])[_0xff7b[84]]= _0x6cfcx12[_0xff7b[90]];document[_0xff7b[80]](_0xff7b[92])[_0xff7b[84]]= false;document[_0xff7b[80]](_0xff7b[94])[_0xff7b[84]]= false;document[_0xff7b[80]](_0xff7b[95])[_0xff7b[84]]= false;switch(_0x6cfcx12[_0xff7b[93]]){case LINE_END_SYMBOL_PUT_INTO_ONE_CELL:document[_0xff7b[80]](_0xff7b[92])[_0xff7b[84]]= true;break;case LINE_END_SYMBOL_PUT_OUTSIDE:document[_0xff7b[80]](_0xff7b[94])[_0xff7b[84]]= true;break;case LINE_END_SYMBOL_PUT_NEXT_LINE:document[_0xff7b[80]](_0xff7b[95])[_0xff7b[84]]= true;break;default:document[_0xff7b[80]](_0xff7b[92])[_0xff7b[84]]= true;break};document[_0xff7b[80]](_0xff7b[97])[_0xff7b[78]]= _0x6cfcx12[_0xff7b[96]]}};function draw(){const _0x6cfcx12=DisplayOption[_0xff7b[98]]();_0x6cfcx12[_0xff7b[99]]();const _0x6cfcx1e=document[_0xff7b[80]](_0xff7b[79])[_0xff7b[78]];const _0x6cfcx26=manuscript[_0xff7b[100]](_0x6cfcx1e,_0x6cfcx12);document[_0xff7b[80]](_0xff7b[102])[_0xff7b[101]]= _0xff7b[103]+ _0x6cfcx26[_0xff7b[102]]+ _0xff7b[104]}function print(){const _0x6cfcx28=window[_0xff7b[107]](_0xff7b[105],_0xff7b[106],_0xff7b[76],true);const _0x6cfcx29=()=>{const _0x6cfcx2a=_0x6cfcx28[_0xff7b[109]][_0xff7b[80]](_0xff7b[108]);const _0x6cfcx2b=_0x6cfcx28[_0xff7b[109]][_0xff7b[80]](_0xff7b[110]);if(_0x6cfcx2a&& _0x6cfcx2b){removeChildren(_0x6cfcx2a);const _0x6cfcx2c= new Manuscript(_0x6cfcx2a,1122* 2,794* 2);_0x6cfcx2c[_0xff7b[100]](manuscript[_0xff7b[111]](),DisplayOption[_0xff7b[98]]());removeChildren(_0x6cfcx2b);_0x6cfcx2c[_0xff7b[118]]()[_0xff7b[117]]((_0x6cfcx2d)=>{const _0x6cfcx2e=_0x6cfcx28[_0xff7b[109]][_0xff7b[113]](_0xff7b[112]);_0x6cfcx2e[_0xff7b[115]](_0xff7b[114],_0x6cfcx2d);_0x6cfcx2b[_0xff7b[116]](_0x6cfcx2e)});setTimeout(()=>{return _0x6cfcx28[_0xff7b[119]]()},100)}else {setTimeout(_0x6cfcx29,100)}};setTimeout(_0x6cfcx29,100)}function removeChildren(_0x6cfcx30){while(_0x6cfcx30[_0xff7b[120]]){_0x6cfcx30[_0xff7b[121]](_0x6cfcx30[_0xff7b[120]])}}class Manuscript{constructor(_0x6cfcx31,_0x6cfcx32= 600,_0x6cfcx33= 500){this[_0xff7b[122]]= _0x6cfcx31;this[_0xff7b[123]]= _0x6cfcx32;this[_0xff7b[124]]= _0x6cfcx33;this[_0xff7b[125]]=  new Array();this[_0xff7b[126]]= _0xff7b[76];this[_0xff7b[127]]= null}draw(_0x6cfcx1e,_0x6cfcx12){this[_0xff7b[127]]= _0x6cfcx12;_0x6cfcx1e= (_0x6cfcx1e[_0xff7b[128]]> 0)?_0x6cfcx1e:_0xff7b[129];if(_0x6cfcx12[_0xff7b[88]]){const _0x6cfcx34={'\x30':_0xff7b[130],'\x31':_0xff7b[131],'\x32':_0xff7b[132],'\x33':_0xff7b[133],'\x34':_0xff7b[134],'\x35':_0xff7b[135],'\x36':_0xff7b[136],'\x37':_0xff7b[137],'\x38':_0xff7b[138],'\x39':_0xff7b[139],'\uFF10':_0xff7b[130],'\uFF11':_0xff7b[131],'\uFF12':_0xff7b[132],'\uFF13':_0xff7b[133],'\uFF14':_0xff7b[134],'\uFF15':_0xff7b[135],'\uFF16':_0xff7b[136],'\uFF17':_0xff7b[137],'\uFF18':_0xff7b[138],'\uFF19':_0xff7b[139]};_0x6cfcx1e= _0x6cfcx1e[_0xff7b[140]](/[0-9０-９]/g,(_0x6cfcx35)=>{return _0x6cfcx34[_0x6cfcx35]})};let _0x6cfcx36= new ManuscriptPageDrawContext(0,JAPANESE_PERIOD);let _0x6cfcx37=0;for(;_0x6cfcx37< this[_0xff7b[125]][_0xff7b[128]]&& _0x6cfcx36[_0xff7b[141]]< _0x6cfcx1e[_0xff7b[128]];_0x6cfcx37++){const _0x6cfcx38=this[_0xff7b[125]][_0x6cfcx37];_0x6cfcx36= _0x6cfcx38[_0xff7b[142]](_0x6cfcx1e,_0x6cfcx36,_0x6cfcx12)};if(_0x6cfcx36[_0xff7b[141]]>= _0x6cfcx1e[_0xff7b[128]]){while(_0x6cfcx37< this[_0xff7b[125]][_0xff7b[128]]){const _0x6cfcx38=this[_0xff7b[125]][_0xff7b[143]]();_0x6cfcx38[_0xff7b[144]]()}};while(_0x6cfcx36[_0xff7b[141]]< _0x6cfcx1e[_0xff7b[128]]){const _0x6cfcx39=document[_0xff7b[113]](_0xff7b[145]);_0x6cfcx39[_0xff7b[115]](_0xff7b[146],Math[_0xff7b[147]](this[_0xff7b[123]],600).toString());this[_0xff7b[122]][_0xff7b[116]](_0x6cfcx39);const _0x6cfcx38= new ManuscriptPage(_0x6cfcx39,20,20);_0x6cfcx36= _0x6cfcx38[_0xff7b[142]](_0x6cfcx1e,_0x6cfcx36,_0x6cfcx12);this[_0xff7b[125]][_0xff7b[148]](_0x6cfcx38)};this[_0xff7b[126]]= _0x6cfcx1e;return  new DrawResult(this[_0xff7b[125]][_0xff7b[128]])}getText(){return this[_0xff7b[126]]}getImages(){return this[_0xff7b[125]][_0xff7b[150]]((_0x6cfcx3c)=>{return _0x6cfcx3c[_0xff7b[149]]()})}resize(){if(this[_0xff7b[127]]){this[_0xff7b[125]][_0xff7b[117]]((_0x6cfcx3c)=>{return _0x6cfcx3c[_0xff7b[144]]()});this[_0xff7b[125]]=  new Array();this[_0xff7b[123]]= this[_0xff7b[122]][_0xff7b[151]];this[_0xff7b[100]](this[_0xff7b[126]],this[_0xff7b[127]])}}};class ManuscriptPageDrawContext{constructor(index,prevChar){this[_0xff7b[152]]= index;this[_0xff7b[153]]= prevChar}get index(){return this[_0xff7b[152]]}get prevChar(){return this[_0xff7b[153]]}};class ManuscriptPage{constructor(_0x6cfcx39,_0x6cfcx40,_0x6cfcx41){this[_0xff7b[154]]= _0x6cfcx40;this[_0xff7b[155]]= _0x6cfcx41;this[_0xff7b[145]]= _0x6cfcx39;this[_0xff7b[156]]= this[_0xff7b[145]][_0xff7b[158]](_0xff7b[157]);this[_0xff7b[159]]= (_0x6cfcx39[_0xff7b[146]]- (OUTER_LINE_WIDTH+ OUTER_LINE_MARGIN)* 2)/ (this[_0xff7b[154]]+ 3)* 3/ 4;this[_0xff7b[160]]= this[_0xff7b[159]]* 0.6;this[_0xff7b[161]]= this[_0xff7b[159]]/ 3;this[_0xff7b[162]]= (this[_0xff7b[154]]+ 1)* (this[_0xff7b[159]]+ this[_0xff7b[161]])+ (OUTER_LINE_WIDTH+ OUTER_LINE_MARGIN)* 2;this[_0xff7b[163]]= this[_0xff7b[155]]* this[_0xff7b[159]]+ this[_0xff7b[159]]* 0.2+ (OUTER_LINE_WIDTH+ OUTER_LINE_MARGIN)* 2;this[_0xff7b[145]][_0xff7b[115]](_0xff7b[164],Math[_0xff7b[165]](this[_0xff7b[163]]+ 40).toString());this[_0xff7b[166]]= (this[_0xff7b[145]][_0xff7b[146]]- this[_0xff7b[162]])/ 2;this[_0xff7b[167]]= (this[_0xff7b[145]][_0xff7b[164]]- this[_0xff7b[163]])/ 2}getCellRectByCharPosition(_0x6cfcx43){const _0x6cfcx44=Math[_0xff7b[168]](_0x6cfcx43/ this[_0xff7b[154]]);const _0x6cfcx45=_0x6cfcx43% this[_0xff7b[154]];return this[_0xff7b[169]](_0x6cfcx44,_0x6cfcx45)}getCellRectByLineAndCharIndex(_0x6cfcx44,_0x6cfcx45){const _0x6cfcx47=(_0x6cfcx44>= this[_0xff7b[154]]/ 2)?_0x6cfcx44+ 1:_0x6cfcx44;const _0x6cfcx48=(this[_0xff7b[154]]- _0x6cfcx47)* (this[_0xff7b[159]]+ this[_0xff7b[161]])+ OUTER_LINE_WIDTH+ OUTER_LINE_MARGIN+ this[_0xff7b[166]];const _0x6cfcx49=_0x6cfcx45* this[_0xff7b[159]]+ OUTER_LINE_WIDTH+ OUTER_LINE_MARGIN+ this[_0xff7b[167]];return {left:_0x6cfcx48,top:_0x6cfcx49,right:_0x6cfcx48+ this[_0xff7b[159]],bottom:_0x6cfcx49+ this[_0xff7b[159]]}}drawGrid(_0x6cfcx12){this[_0xff7b[156]][_0xff7b[170]](0,0,this[_0xff7b[145]][_0xff7b[146]],this[_0xff7b[145]][_0xff7b[164]]);const _0x6cfcx4b=this[_0xff7b[169]](this[_0xff7b[154]]/ 2- 1,0);const _0x6cfcx4c=this[_0xff7b[169]](this[_0xff7b[154]]/ 2,0);this[_0xff7b[156]][_0xff7b[171]]= _0x6cfcx12[_0xff7b[96]];this[_0xff7b[156]][_0xff7b[172]]= 1;for(let _0x6cfcx44=0;_0x6cfcx44< this[_0xff7b[154]];_0x6cfcx44++){for(let _0x6cfcx45=0;_0x6cfcx45< this[_0xff7b[155]];_0x6cfcx45++){const _0x6cfcx4d=this[_0xff7b[169]](_0x6cfcx44,_0x6cfcx45);this[_0xff7b[156]][_0xff7b[177]](_0x6cfcx4d[_0xff7b[173]],_0x6cfcx4d[_0xff7b[174]],_0x6cfcx4d[_0xff7b[175]]- _0x6cfcx4d[_0xff7b[173]],_0x6cfcx4d[_0xff7b[176]]- _0x6cfcx4d[_0xff7b[174]])}};this[_0xff7b[156]][_0xff7b[178]]();this[_0xff7b[156]][_0xff7b[179]](_0x6cfcx4c[_0xff7b[175]]+ this[_0xff7b[161]],_0x6cfcx4c[_0xff7b[174]]);this[_0xff7b[156]][_0xff7b[180]](_0x6cfcx4c[_0xff7b[175]]+ this[_0xff7b[161]],_0x6cfcx4c[_0xff7b[174]]+ this[_0xff7b[155]]* this[_0xff7b[159]]);this[_0xff7b[156]][_0xff7b[181]]();const _0x6cfcx4e=this[_0xff7b[169]](this[_0xff7b[154]]- 1,0);const _0x6cfcx4f=this[_0xff7b[169]](0,this[_0xff7b[155]]- 1);this[_0xff7b[156]][_0xff7b[172]]= OUTER_LINE_WIDTH;this[_0xff7b[156]][_0xff7b[177]](_0x6cfcx4e[_0xff7b[173]]- OUTER_LINE_WIDTH/ 2,_0x6cfcx4e[_0xff7b[174]]- OUTER_LINE_WIDTH/ 2,_0x6cfcx4f[_0xff7b[175]]- _0x6cfcx4e[_0xff7b[173]]+ this[_0xff7b[161]]+ OUTER_LINE_WIDTH/ 2,_0x6cfcx4f[_0xff7b[176]]- _0x6cfcx4e[_0xff7b[174]]+ OUTER_LINE_WIDTH/ 2);_0x6cfcx4c[_0xff7b[175]]+= this[_0xff7b[161]];const _0x6cfcx50=this[_0xff7b[159]]/ 8;const _0x6cfcx51=this[_0xff7b[159]]/ 4;const _0x6cfcx52=this[_0xff7b[159]]/ 2+ this[_0xff7b[159]]* 3;this[_0xff7b[156]][_0xff7b[182]]= _0x6cfcx12[_0xff7b[96]];this[_0xff7b[156]][_0xff7b[178]]();this[_0xff7b[156]][_0xff7b[179]](_0x6cfcx4b[_0xff7b[173]]- _0x6cfcx50,_0x6cfcx4b[_0xff7b[176]]+ _0x6cfcx51+ _0x6cfcx52);this[_0xff7b[156]][_0xff7b[180]](_0x6cfcx4b[_0xff7b[173]]- _0x6cfcx50,_0x6cfcx4b[_0xff7b[176]]+ _0x6cfcx52);this[_0xff7b[156]][_0xff7b[180]](_0x6cfcx4c[_0xff7b[175]]+ _0x6cfcx50,_0x6cfcx4c[_0xff7b[176]]+ _0x6cfcx52);this[_0xff7b[156]][_0xff7b[180]](_0x6cfcx4c[_0xff7b[175]]+ _0x6cfcx50,_0x6cfcx4c[_0xff7b[176]]+ _0x6cfcx51+ _0x6cfcx52);this[_0xff7b[156]][_0xff7b[183]]((_0x6cfcx4c[_0xff7b[175]]+ _0x6cfcx4b[_0xff7b[173]])/ 2,_0x6cfcx4c[_0xff7b[176]]+ _0x6cfcx52,_0x6cfcx4b[_0xff7b[173]]- _0x6cfcx50,_0x6cfcx4b[_0xff7b[176]]+ _0x6cfcx51+ _0x6cfcx52,this[_0xff7b[159]]);this[_0xff7b[156]][_0xff7b[184]]();this[_0xff7b[156]][_0xff7b[185]](_0x6cfcx4c[_0xff7b[175]]+ _0x6cfcx50,_0x6cfcx4c[_0xff7b[174]]+ this[_0xff7b[155]]* this[_0xff7b[159]]- _0x6cfcx52- this[_0xff7b[159]],_0x6cfcx4b[_0xff7b[173]]- _0x6cfcx4c[_0xff7b[175]]- _0x6cfcx50* 2,_0x6cfcx51/ 2)}drawText(_0x6cfcx1e,_0x6cfcx36,_0x6cfcx12){this[_0xff7b[186]](_0x6cfcx12);this[_0xff7b[156]][_0xff7b[187]]= this[_0xff7b[160]].toString()+ _0xff7b[188];this[_0xff7b[156]][_0xff7b[182]]= TEXT_COLOR;let _0x6cfcx44=0;let _0x6cfcx45=0;let prevChar=_0x6cfcx36[_0xff7b[189]];let index=_0x6cfcx36[_0xff7b[141]];while(index< _0x6cfcx1e[_0xff7b[128]]&& _0x6cfcx44< this[_0xff7b[154]]){let _0x6cfcx54=this[_0xff7b[190]](_0x6cfcx1e,index);if(_0x6cfcx54=== _0xff7b[191]){_0x6cfcx44++;_0x6cfcx45= 0;index++;continue};let _0x6cfcx55=0;let _0x6cfcx56=0;let _0x6cfcx57=-1;let _0x6cfcx58=false;if(_0x6cfcx12[_0xff7b[83]]&& _0x6cfcx45=== 0&& prevChar=== JAPANESE_PERIOD&&  !this[_0xff7b[192]](_0x6cfcx54)){_0x6cfcx45++};if(_0x6cfcx12[_0xff7b[86]]&& this[_0xff7b[193]](_0x6cfcx54)&& index< _0x6cfcx1e[_0xff7b[128]]- 1){const _0x6cfcx59=_0x6cfcx1e[_0xff7b[194]](index+ 1);if(this[_0xff7b[193]](_0x6cfcx59)){_0x6cfcx54+= _0x6cfcx59}};if(_0x6cfcx45>= this[_0xff7b[155]]){if(_0x6cfcx12[_0xff7b[93]]!== LINE_END_SYMBOL_PUT_NEXT_LINE&& (_0x6cfcx54=== JAPANESE_COMMA|| _0x6cfcx54=== JAPANESE_PERIOD|| _0x6cfcx54=== JAPANESE_BRACKET_END)){if(_0x6cfcx12[_0xff7b[93]]=== LINE_END_SYMBOL_PUT_INTO_ONE_CELL){_0x6cfcx45--;_0x6cfcx58= true}else {if(_0x6cfcx45>= this[_0xff7b[155]]+ 1){_0x6cfcx45--}}}else {_0x6cfcx44++;_0x6cfcx45= 0}}else {if(prevChar=== JAPANESE_PERIOD&& _0x6cfcx54=== JAPANESE_BRACKET_END){_0x6cfcx45--}};if(_0x6cfcx45=== 0&& _0x6cfcx12[_0xff7b[90]]&& _0x6cfcx54=== _0xff7b[195]){_0x6cfcx54= prevChar};if(_0x6cfcx44>= this[_0xff7b[154]]){break};if(_0x6cfcx58){_0x6cfcx57+= this[_0xff7b[160]]* 0.9};let _0x6cfcx5a=false;let _0x6cfcx5b=false;if(ROTATE_CHARS[_0xff7b[196]](_0x6cfcx54)|| (_0x6cfcx12[_0xff7b[86]]&& this[_0xff7b[193]](_0x6cfcx54[_0xff7b[194]](0)))){_0x6cfcx5a= true;_0x6cfcx55= Math[_0xff7b[197]]/ 2;[_0x6cfcx56,_0x6cfcx57]= [_0x6cfcx57,_0x6cfcx56];_0x6cfcx56-= this[_0xff7b[160]];_0x6cfcx57-= this[_0xff7b[160]]* 0.1;if(this[_0xff7b[193]](_0x6cfcx54[_0xff7b[194]](0))){this[_0xff7b[156]][_0xff7b[187]]= this[_0xff7b[160]].toString()+ _0xff7b[198];_0x6cfcx5b= true}};if(UPPER_RIGHT_MARK[_0xff7b[196]](_0x6cfcx54)){_0x6cfcx56+= this[_0xff7b[160]]* 2/ 3;_0x6cfcx57-= this[_0xff7b[160]]* 4/ 5}else {if(UPPER_RIGHT_CHARS[_0xff7b[196]](_0x6cfcx54)){_0x6cfcx56+= this[_0xff7b[160]]* 2/ 8;_0x6cfcx57-= this[_0xff7b[160]]* 4/ 12}};const _0x6cfcx4d=this[_0xff7b[169]](_0x6cfcx44,_0x6cfcx45);this[_0xff7b[156]][_0xff7b[99]]();const _0x6cfcx5c=this[_0xff7b[156]][_0xff7b[199]](_0x6cfcx54);const _0x6cfcx5d=_0x6cfcx4d[_0xff7b[173]]+ (_0x6cfcx4d[_0xff7b[175]]- _0x6cfcx4d[_0xff7b[173]]- (_0x6cfcx5a?this[_0xff7b[160]]:_0x6cfcx5c[_0xff7b[146]]))/ 2;const _0x6cfcx5e=_0x6cfcx4d[_0xff7b[176]]- (_0x6cfcx4d[_0xff7b[176]]- _0x6cfcx4d[_0xff7b[174]]- (_0x6cfcx5a?_0x6cfcx5c[_0xff7b[146]]:this[_0xff7b[160]]))/ 2;this[_0xff7b[156]][_0xff7b[200]](_0x6cfcx5d,_0x6cfcx5e);this[_0xff7b[156]][_0xff7b[201]](_0x6cfcx55);this[_0xff7b[156]][_0xff7b[200]](-_0x6cfcx5d,-_0x6cfcx5e);this[_0xff7b[156]][_0xff7b[202]](_0x6cfcx54,_0x6cfcx5d+ _0x6cfcx56,_0x6cfcx5e+ _0x6cfcx57);this[_0xff7b[156]][_0xff7b[203]]();if(_0x6cfcx5b){this[_0xff7b[156]][_0xff7b[187]]= this[_0xff7b[160]].toString()+ _0xff7b[188]};_0x6cfcx45++;prevChar= _0x6cfcx54;index+= _0x6cfcx54[_0xff7b[128]]};return  new ManuscriptPageDrawContext(index,prevChar)}isHalf(_0x6cfcx54){return _0x6cfcx54[_0xff7b[204]](0)>= 0x00&& _0x6cfcx54[_0xff7b[204]](0)<= 0xFF}isSpace(_0x6cfcx54){return _0x6cfcx54=== _0xff7b[129]|| _0x6cfcx54=== _0xff7b[205]|| _0x6cfcx54=== _0xff7b[206]}getChar(_0x6cfcx1e,index){const _0x6cfcx62=_0x6cfcx1e[_0xff7b[204]](index);let _0x6cfcx63=index+ 1;if(_0x6cfcx63< _0x6cfcx1e[_0xff7b[128]]&& _0x6cfcx62>= 0xD800&& _0x6cfcx62<= 0xDBFF){const _0x6cfcx64=_0x6cfcx1e[_0xff7b[204]](_0x6cfcx63);if(_0x6cfcx64>= 0xDC00&& _0x6cfcx64<= 0xDFFF){_0x6cfcx63++}};if(_0x6cfcx63< _0x6cfcx1e[_0xff7b[128]]- 1){const _0x6cfcx64=_0x6cfcx1e[_0xff7b[204]](_0x6cfcx63);if(_0x6cfcx64=== 0xDB40){_0x6cfcx63+= 2}};return _0x6cfcx1e[_0xff7b[207]](index,_0x6cfcx63)}getImage(){return this[_0xff7b[145]][_0xff7b[209]](_0xff7b[208])}destroy(){this[_0xff7b[145]][_0xff7b[210]]()}};DisplayOption[_0xff7b[82]](DrawOption[_0xff7b[211]]());const manuscript= new Manuscript(document[_0xff7b[80]](_0xff7b[212]));restoreText();draw();function resizeCanvas(){if(manuscript){manuscript[_0xff7b[213]]()}}window[_0xff7b[214]](_0xff7b[213],resizeCanvas,false)
</script>
@endsection