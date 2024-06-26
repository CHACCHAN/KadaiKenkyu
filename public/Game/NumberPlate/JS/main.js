// ナンプレの問題を生成する関数
function generateSudoku() {
  // 9x9の二次元配列を生成し、0で初期化
  const board = Array.from({ length: 9 }, () => Array(9).fill(0));

  // ボードを埋める
  fillBoard(board);

  // 完成したボードを返す
  return board;
}

// ボードを埋める関数
function fillBoard(board) {
  // 各セルを順に見ていく
  for (let i = 0; i < 9; i++) {
      for (let j = 0; j < 9; j++) {
          // セルが空（0）であれば
          if (board[i][j] === 0) {
              // 1から9までの数字をシャッフルした配列を生成
              const numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];
              shuffleArray(numbers);

              // 配列の数字を順に試す
              for (let num of numbers) {
                  // その数字がそのセルに置けるかどうかをチェック
                  if (isValid(board, i, j, num)) {
                      // 数字が置ける場合は、その数字をセルに置く
                      board[i][j] = num;

                      // 次のセルに進む
                      if (fillBoard(board)) {
                          return true; // valid solution
                      }

                      // 数字が置けない場合は、別の数字を試す
                      board[i][j] = 0; // undo current cell for backtracking
                  }
              }

              // 全ての数字を試してもダメな場合は、一つ前のセルに戻る（バックトラック）
              return false; // no valid number can be placed in this cell
          }
      }
  }

  // 全てのセルが埋まったらtrueを返す
  return true; // all cells are filled
}

// 指定された数字が指定されたセルに置けるかどうかをチェックする関数
function isValid(board, row, col, num) {
  // 同じ行、同じ列、および同じ3x3のブロック内に同じ数字がないかをチェック
  for (let i = 0; i < 9; i++) {
      const m = 3 * Math.floor(row / 3) + Math.floor(i / 3);
      const n = 3 * Math.floor(col / 3) + i % 3;
      if (board[row][i] === num || board[i][col] === num || board[m][n] === num) {
          return false; // not valid
      }
  }
  return true; // valid
}

// 与えられた配列をシャッフルする関数
function shuffleArray(array) {
  // 配列の最後の要素から順に、その要素とランダムに選ばれた要素を交換
  for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}

// ナンプレの問題を生成
const question = generateSudoku();

// 各行にランダムに0を挿入
for (let i = 0; i < 9; i++) {
  const zeros = Math.floor(Math.random() * 3) + 3; // 3から5までのランダムな数
  for (let j = 0; j < zeros; j++) {
      let index;
      do {
          index = Math.floor(Math.random() * 9);
      } while (question[i][index] === 0);
      question[i][index] = 0;
  }
}


// クリックされた要素を保持
let place;

init();
// ゲーム画面生成
function init() {
  const main = document.querySelector(".main");
  startShowing();
  const countflag = 0;
  const select = document.querySelector(".select");

  for (let i = 0; i < 9; i++) {
      let tr = document.createElement("tr");
      for (let j = 0; j < 9; j++) {
          let td = document.createElement("td");
          td.onclick = mainClick;
          tr.appendChild(td);
          if (question[i][j] != 0) {
              td.textContent = question[i][j];
              td.classList.add("clickdisable");
          } else {
              td.textContent = null;
              td.classList.add("clickenable");
          }
      }
      main.appendChild(tr);
  }

  for (let i = 0; i < 9; i++) {
      let td = document.createElement("td");
      td.onclick = selectClick;
      td.value = i + 1;
      select.appendChild(td);
      td.textContent = i + 1;
  }
}

// 問題パネルのマスが押された時の処理
function mainClick(e) {
  if (place != undefined) {
      place.classList.remove("mainClick");
  }

  place = e.target;
  place.classList.add("mainClick");
}

// 数字選択のマスが押された時の処理
function selectClick(e) {
  place.textContent = e.target.value;
}

// 正解判定
function check() {
  const h2 = document.querySelector("h2");
  const tr = document.querySelectorAll(".main tr");
  let checkFlag = true;
  // 横計算
  for (let i = 0; i < 9; i++) {
      let sum = 0;
      let td = tr[i].querySelectorAll("td");
      for (let j = 0; j < 9; j++) {
          sum += Number(td[j].textContent);
      }
      if (sum != 45) {
          checkFlag = false;
          break;
      }
  }
  // 縦計算
  for (let i = 0; i < 9; i++) {
      let sum = 0;
      for (let j = 0; j < 9; j++) {
          let td = tr[j].querySelectorAll("td");
          sum += Number(td[i].textContent);
      }
      if (sum != 45) {
          checkFlag = false;
          break;
      }
  }
  if (checkFlag) {
      h2.textContent = "正解です!!";
      if (countflag == 0) {
          stopShowing();
      }
  } else {
      h2.textContent = "間違いがあります";
  }
}

//消す処理
function remove() {
  place.textContent = null;
}


// ナンプレの問題を解く関数
function solveSudoku(board) {
  countflag = 1;
  for (let i = 0; i < 9; i++) {
      for (let j = 0; j < 9; j++) {
          if (board[i][j] === 0) {
              for (let num = 1; num <= 9; num++) {
                  if (isValid(board, i, j, num)) {
                      board[i][j] = num;
                      if (solveSudoku(board)) {
                          return true;
                      }
                      board[i][j] = 0;
                  }
              }
              return false;
          }
      }
  }
  return true;
}

// 「答えを埋める」ボタンがクリックされたときに実行される関数
document.getElementById('fill-answers-button').onclick = function fillAnswers() {
  // 問題を解く
  solveSudoku(question);

  // 結果を画面に表示
  const main = document.querySelector(".main");
  for (let i = 0; i < 9; i++) {
      for (let j = 0; j < 9; j++) {
          main.rows[i].cells[j].textContent = question[i][j];
      }
  }
};

//ルール説明に使っている関数
// ページのロードが終わったらtoast表示
const snack = document.getElementById("topSnack"); // toastのID指定
window.addEventListener('load', () => { //ロード完了後イベント開始
  snack.className = "show"; // snackbarを表示
});

// バツをクリックで非表示
const snackClose = document.getElementById("topSnack"); // toastのID指定
snackClose.addEventListener('click', () => { //クリックでイベント開始
  snack.classList.remove('show'); // snackbarを非表示
});


//カウント用
var PassSec;   // 秒数カウント用変数これで!!!!!!!!!!

// 繰り返し処理の中身
function showPassage() {
  PassSec++;   // カウントアップ
  var msg = "ナンプレを始めてから " + PassSec + "秒が経過しました。";   // 表示文作成
  document.getElementById("PassageArea").innerHTML = msg;   // 表示更新
}

// 繰り返し処理の開始
function startShowing() {
  PassSec = 0;   // カウンタのリセット
  countflag = 0;
  PassageID = setInterval('showPassage()', 1000);   // タイマーをセット(1000ms間隔)
  document.getElementById("startcount").disabled = true;   // 開始ボタンの無効化
}

// 繰り返し処理の中止
function stopShowing() {
  clearInterval(PassageID);   // タイマーのクリア
  document.getElementById("startcount").disabled = false;   // 開始ボタンの有効化
}

document.addEventListener('DOMContentLoaded', function () {
  document.getElementById("btn").addEventListener("click", function () {
      countflag = 0;
      window.location.reload();
  })
});