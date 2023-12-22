
function statusUpdate(usid,jbid){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?route=Condidat&upUsId=' + usid +'&upJbId='+jbid, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var btn = document.getElementById('accept-btn')	;
                  btn.style="background-color:gray;"	;	
            console.log(xhr.responseText);
            alert("hhh");
      }
      };
      xhr.send();
      
      } 


      function showNontification() {
        var Nontif = document.getElementById('N-card');
    
        if (Nontif.style.display == "block") {
            Nontif.style.display = "none";
        } else {
            Nontif.style.display = "block";
        }
    }
    
            function searchKey() {
                const searchTerm = document.getElementById('keywords').value;
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'index.php?route=Search&term=' + searchTerm, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('result').innerHTML = xhr.responseText;
                
                    }
                    };
                    xhr.send();
                    }
            searchKey();
    
            function apply(id){
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'index.php?route=Dashboard&applyid=' + id, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                                    
                        console.log(xhr.responseText);
                        alert("apply secces");
                    }
                    };
                    xhr.send();
                    
                    }
                    // i dont know why hdi mkhdamach ?!
                    const annuler = document.querySelector('.annuler');
                    console.log(annuler);
                    console.log("--------------------------");
                    annuler.addEventListener('click', () => {
                      alert('annuler');
                      modal.style.display = 'none';
                    })