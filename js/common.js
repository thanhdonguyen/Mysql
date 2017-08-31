// Loadingイメージ表示関数
function dispLoading(msg){
    // 画面表示メッセージ
    var dispMsg = "";
 
    // 引数が空の場合は画像のみ
    if( msg != "" ){
        dispMsg = "<div class='loadingMsg'>" + msg + "</div>";
    }
    // ローディング画像が表示されていない場合のみ表示
    if($("#loading").size() == 0){
        $("body").append("<div id='loading'>" + dispMsg + "</div>");
    } 
}
 
// Loadingイメージ削除関数
function removeLoading(){
 $("#loading").remove();
}

// Loadingイメージの実装サンプル
// dispLoading("処理中...");	//Loading表示
// removeLoading();			//Loading表示削除


// Message Box & Confirm Message Boxの実装サンプル
// Message Box
// $.message("注意", "ただいま保存作業中、しばらくお待ちください。");
// Confirm Message Box
// $.confirm("警告", "選択した権限IDを登録します。よろしいですか？")
// .done(function() {
//    // 「はい」ボタンがクリックされた
//    console.log("Confirm OK Clicked");
// })
// .fail(function() {
//    // 「いいえ」ボタンや「×」ボタンがクリックされた
//    console.log("Confirm Cancel Clicked");
// });

function modalAlert(){
	var modalHtml = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
	modalHtml += '<div class="modal-dialog" role="document">';
	modalHtml += '<div class="modal-content">';
	modalHtml += '<div class="modal-header">';
	modalHtml += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
	modalHtml += '<span aria-hidden="true">&times;</span></button>';
	modalHtml += '<h4 class="modal-title" id="myModalLabel">統括共通フラッシュメッセージ</h4>';
	modalHtml += '</div>';
	modalHtml += '<div class="modal-body" id="myModalBodyLabel"><p>保存完了しました。</p></div>';
	modalHtml += '<div class="modal-footer">';
	modalHtml += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
	modalHtml += '</div></div></div></div>';
	$("body").append(modalHtml);
}

$(document).ready(function() {
	modalAlert();
});


(function($) {
    $.message = function(title, body) {
        var deferred = $.Deferred();
        var $element = $("#myModal");

        $element.data("resolve", false)
        	.find(".modal-title").text(title).end()
            .find(".modal-body p").text(body).end()
            .find(".modal-footer .btn-default").focus().end()
            .on("click", ".btn-default", function() {
                $element.data("resolve", true).modal("hide");
            })
            .one("hidden.bs.modal", function() {
                $(this).off("click", ".btn-default");
                if($(this).data("resolve")) {
                    deferred.resolve();
                } else {
                    deferred.reject();
                }
            })
            .modal({ show: true });
        return deferred.promise();
    
    };
})(jQuery);

// Confirm Message Box
function modalConfirm(){
	var modalHtml = '<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
	modalHtml += '<div class="modal-dialog" role="document">';
	modalHtml += '<div class="modal-content">';
	modalHtml += '<div class="modal-header">';
	modalHtml += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
	modalHtml += '<span aria-hidden="true">&times;</span></button>';
	modalHtml += '<h4 class="modal-title"></h4>';
	modalHtml += '</div>';
	modalHtml += '<div class="modal-body" id="myModalBodyLabel"><p></p></div>';
	modalHtml += '<div class="modal-footer">';
	modalHtml += '<button type="button" class="btn btn-primary">OK</button>';
	modalHtml += '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
	modalHtml += '</div></div></div></div>';
	$("body").append(modalHtml);
}

$(document).ready(function() {
	modalConfirm();
});

(function($) {
    $.confirm = function(title, message) {
        var deferred = $.Deferred();

        var $element = $("#confirmModal");
        $element
            .data("resolve", false) // resolve するかどうかのフラグ
                // タイトルを設定
                .find(".modal-title").text(title).end()
                // メッセージを設定
                .find(".modal-body p").text(message).end()
            //「はい」ボタンのクリックイベント
            .on("click", ".btn-primary", function() {
                // resolve フラグを立てて、モーダルを閉じる
                $element
                    .data("resolve", true)
                    .modal("hide");
            })
            // モーダルの非表示イベント
            .one("hidden.bs.modal", function() {
                $(this).off("click", ".btn-primary");

                // resolveフラグをみて resolve か reject
                if($(this).data("resolve")) {
                    deferred.resolve();
                } else {
                    deferred.reject();
                }
            })
            .modal({ show: true });

        return deferred.promise();
    };
})(jQuery);

//Confirm Message Box
function modalDialog(){
	var dialogHtml = '<div class="modal fade" id="pasteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
	dialogHtml += '<div class="modal-dialog" role="document">';
	dialogHtml += '<div class="modal-content">';
	dialogHtml += '<div class="modal-header">';
	dialogHtml += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
	dialogHtml += '<span aria-hidden="true">&times;</span></button>';
	dialogHtml += '<h4 class="modal-title"></h4>';
	dialogHtml += '</div>';
	dialogHtml += '<div class="modal-body" id="myModalBodyLabel"><p></p>';
	dialogHtml += '<textarea class="form-control" id="pasteText" rows="5"></textarea></div>';
	dialogHtml += '<div class="modal-footer">';
	dialogHtml += '<button type="button" class="btn btn-primary">OK</button>';
	dialogHtml += '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
	dialogHtml += '</div></div></div></div>';
	$("body").append(dialogHtml);
}

$(document).ready(function() {
	modalDialog();
});

(function($) {
    $.pastedialog = function(title, message) {
        var deferred = $.Deferred();

        var $element = $("#pasteModal");
        $element
            .data("resolve", false) // resolve するかどうかのフラグ
                // タイトルを設定
                .find(".modal-title").text(title).end()
                // メッセージを設定
                .find(".modal-body p").text(message).end()
            //「はい」ボタンのクリックイベント
            .on("click", ".btn-primary", function() {
                // resolve フラグを立てて、モーダルを閉じる
                $element
                    .data("resolve", true)
                    .modal("hide");
            })
            // モーダルの非表示イベント
            .one("hidden.bs.modal", function() {
                $(this).off("click", ".btn-primary");

                // resolveフラグをみて resolve か reject
                if($(this).data("resolve")) {
                    deferred.resolve();
                } else {
                    deferred.reject();
                }
            })
            .modal({ show: true });

        return deferred.promise();
    };
})(jQuery);
