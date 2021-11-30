<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing PDF JS</title>
     <script src="pdf-dist/build/pdf.js"></script>
    <script src="pdf-dist/build/pdf.worker.js"></script> 
    <style>
        #the-canvas {
  border: 1px solid black;
  direction: ltr;
}
    </style>
</head>
<body>
    <div>
        <button id="prev">Previous</button>
        <button id="next">Next</button>
        &nbsp; &nbsp;
        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
      </div>
      <canvas id="pdf-render"></canvas>
<!--<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>-->
      <script>
         // var url="https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/examples/learning/helloworld.pdf";
//          var url = "http://apajuris.in/work/ClientCaseData/Neelamraj Soni/Neelamraj Soni Vs Shreepati Jewels & Ors (RERA Complaint against Builder for Delay in Possession)/ClientBrief/1 RERA Neelam Raj Soni Peition 4 Sep 2020.pdf";
   var url ="pdfs/1 RERA Neelam Raj Soni Peition 4 Sep 2020.pdf";
      //  var url="http://127.0.0.1:5500/testingpdf.pdf";
          let pdfDoc= null,
          pageNum =1,
          pageIsRendering = false,
         pageNumIsPending = null;

         const scale=1.5,
         canvas= document.querySelector('#pdf-render'),
         ctx= canvas.getContext('2d');

         const renderPage = num=>{

            pageIsRendering= true;

            pdfDoc.getPage(num).then(page=>{

                console.log(page);

                const viewport = page.getViewport({ scale });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderCtx ={
                    canvasContext :ctx,
                    viewport
                }
                page.render(renderCtx).promise.then(()=>{
                    pageIsRendering = false;

                    if(pageNumIsPending !== null){
                        renderPage(pageNumIsPending);
                        pageNumIsPending = null;
                    }
                });

                document.querySelector('#page_num').textContent = num;
            })
    
         }

         pdfjsLib.getDocument(url).promise.then(pdfDoc_ =>{
            pdfDoc= pdfDoc_;
            console.log(pdfDoc);

          document.querySelector('#page_count').textContent = pdfDoc.numPages;

          renderPage(pageNum)

         });

      </script>

     
</body>

</html>