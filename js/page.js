 
      var firstPage;
      var lastPage;
      var imgSrcPrefix;
      var currentPage;
      
      
      function setup()
      {
      countSpan = document.getElementById("countPages");
      firstPage = parseInt(countSpan.getAttribute("title"));
      lastPage = firstPage + parseInt(countSpan.innerHTML);
      imageSrc = document.getElementById("mainImage").src;
      imgSrcPrefix = imageSrc.substring(0, (imageSrc.length - 7));
      currentPage = parseInt(imageSrc.substring((imageSrc.length - 7), (imageSrc.length - 4)));
      }
      
      function nextPage()
      {
      goToPage(currentPage + 1);
      }
      
      function previousPage()
      {
      goToPage(currentPage - 1);
      }
      
      function goToForm()
      {
      goToPage(document.getElementById("pageIdBox").value);
      }
      
      function goToPage(pageNo)
      {
      var p;
      
      if (pageNo < firstPage)
      {
      p = firstPage;
      }
      else if (pageNo > lastPage)
      {
      p = lastPage;
      }
      else if (!((pageNo >= firstPage) && (pageNo <= lastPage)))
      {
      p = firstPage;
      }
      else
      {
      p = parseInt(pageNo);
      }
      
      currentPage = p;
      
      //change prev/next links
      if (currentPage == firstPage)
      {
      document.getElementById("previousLink").innerHTML = "";
      } 
      else
      {
      document.getElementById("previousLink").innerHTML = '<a href="javascript:previousPage()" onclick="previousPage(); return false;">Previous</a>';
      }
      
      if (currentPage == lastPage)
      {
      document.getElementById("nextLink").innerHTML = "";
      } 
      else
      {
      document.getElementById("nextLink").innerHTML = '<a href="javascript:nextPage()" onclick="nextPage(); return false;">Next</a>';
      }
      
      
      var newSrc = imgSrcPrefix + pageNoFormat(p) + '.jpg';
      //Change image
	  document.getElementById("mainImage").src = "loading.jpg";
      document.getElementById("mainImage").src = newSrc;
      //Change page on form
      document.getElementById("pageIdBox").value = currentPage;
      
      
      }
      
      function pageNoFormat(pageNo)
      {
      pageNoStr = pageNo + '';
      if (pageNoStr.length == 1)
      {
      pageNoStr = '00' + pageNoStr;
      }
      else if (pageNoStr.length == 2)
      {
      pageNoStr = '0' + pageNoStr;
      }
      
      return pageNoStr;
      }
 