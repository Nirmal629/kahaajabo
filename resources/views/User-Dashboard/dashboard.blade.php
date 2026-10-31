@extends('User-Dashboard.Layouts.App')
@section('main-content')

 <div class="container-fluid">
    <div class="col-12">
        <div class="topHead_title">
            <h3 class="pageTitle">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAACbSURBVHgB7ZS9DcIwEIWff9J7hIwADRIjIUag8RKInWhgAzKCe3wXnDR0jk9JE+leZUuf9L3mnUFJvD8PYBNQi89DvJwHKW/i49Vb8AcNYaYjbJckvAdyD9gWHq60JpuDhG8jV0QFKthA0LkxtcJU1inlzfSY1uzmwVWa8Jhu19Nbyvv5x99AbFBvQ//mAl5v0WJUoIINBLu/RT+cpnQk4e3X2wAAAABJRU5ErkJggg=="
                    class="img-fluid mr-2"> User Dasboard
            </h3>
        </div>
    </div>
    <div class="row dashboard-box">
        <div class="col-xl-4 col-md-6 col-lg-4 col-12 mb-2">
            <div class="itemstcok">
                <h2>Total rides</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="countnumber">27</h4>
                    <div class="icon_area"><img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAM1SURBVHgB7ZpBTxNBFMffTHebGNOGHtQoEhuDKRxQUE8c1MrNC3wAvHCTC964YIDEC57koh9Ab3qAswJyEQNoG3qwJASaaDGtsYtUQ9Ld7jhvZWu3trKZZuNu2V9S0p3Zad5/5v3fzJIlUENK+XqLSHQQdDLEgEXBRRAgSSAsqZZL032Rsxlr3yEJZactILVNEl2/Dx6AUHisapQLiuwZ1/gHRcg0vMQAesFD4AqpOomjGIoNuBJeE4Hw1O+VJX0Sv5OE8iUq0eAOeBhN1+NUDgQnweNIQIYoY95LqVoIJYMk9f0bgxaAQovgC3EbvhC34Quxy+7BT+PjNBI4xGL+M0xsvIWiphrX506chNHOyzDYfhGcwJEVmc9uw9iH5YoIBFdlIrViCHQCR4Q82dpo2DexsQJO0LSQolqCtUIe0vuKcX2UJ4paqdKPY3Bs9uAHNEtTHnmeSRuzb6YQ5v/whS5bY8cSy7CY+5Nm493X+dgYiCK8IjiLM+n3Fh+gN5a4B9DYjcC+xfwniwhk5uO6sbqiCAtZK+Qato93X2s4Dmd+IVff8AtcoCiOmP326Q6YvXrDsjKxcIS33eR95yEsBeuOC8tBEEXYIwNnOuDpVuovY5v7BIrBj9lfLWo4GjPSqxrsx/tFaerBCoNEs2M6tfNAhqPdEAu1wYPUO16RChb/mKDQe509sM6rFRaLfV7FcOzDnv5/estRIWhODDbLBXVxARjUyOrrI48kGPDL/jvG93RxD0KSbIgJ/Y/UesQr1jM+oyYveGCbRcXWuQrvmdvdhgGeSiOrryrteITB1RJByOyYTtUikC5u5kaVrB6bfDOsTSX8XfSdCEJCcL9witoJsouQECeP5XiEEcF/sHIbx1tISBKv9079tpCQ0Uv1a31IlsEujQK+G7X3GFCL8M5eVFVLhTH3BLsVDYWg8Or7zTYR/H9iuw1fiNvwhbiN1hFCADLgfZK0rLN58DgEhVBgc+BxVJ1O057IqTegs1nwKjz2vkgkY5hdg8AU4CtE3iP5O/bDqoVv12g6iXtqZXismk7jltecqkkoSjQA5SlCyBXe66rXOwiDDGNYnNicYYkqfgFGel/njItycwAAAABJRU5ErkJggg=="
                            alt="" class="img-fluid"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 col-lg-4 col-12 mb-2">
            <div class="itemstcok">
                <h2>Total complaints</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="countnumber">300</h4>
                    <div class="icon_area"><img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAJ8SURBVHgB7ZpNTxNBGICfmenSRvkwwRgT4ELAmMAf8BfgnaBnTbwaD5wJXjxJNF49eIdwhxs3/4Be1HBBj0QpH7Z0Z8d5+2EKwQjdpeyQfZJ2p7tt8z477zsz7a7iFAt8GrhLudJAVSocG3KEwTQsR/EPvu6v8ch2H1OdhsOp53wbMjRuEgCW6PAdU/sK5eR1U0QkFvkyarERASE99Jp7uyKjZYf0RGgSgsQssUtbLbBqxpi9Q8DcItnVY0wPETi7fnDSBlsicMocVbTlRnC1cZqYyGiuCYVI3ihE8kYhkjcKkaywJBMx5o1FzZGC1MsTi5mgBzRuLyEeSTDrkIz7HxWPNfq+IqnSA6lEYtRLR/KMC+M++6cXXuKD34639+0oXE8SQs+p5dDD/iz2JKGbEuqERAkzTwp6FpG04ML8W0Jhv5OCrJbwVR/gk7MO+F572Ok5jVpKIHMJISuRYR/g+v/e5Fr/EfyV8PJPSVEX3fR1+PXFvOcD/+gTc1MkfIq99XuHyYC+plYrcDZEyfegtGfIiL6mFq3AMwu+m2uzRLn01DqL9siVSW106HdqXRrF6tegd9prphTI+ir9ZCikSq0Sej7BPfCPRT+kzsjk5me8pfN+3p+MjWbFZEAqEVly+wsom75VbdWIel/CrZ7/G7KREDKpEdOcrVmJcCtcEZkV+1VKCMWolTcKkbxRiOSNQiRv6BoNS+DIjQM64neNwClRauhRBoMX2WbyQC8zezxC9ZBAGSE6XEPZZrErNg4kzwgMiXmZqf1W27PFlpvjdq3MhKpTHiAApCdeMf3rxG1O3SzgzCTbgzE/o7zdFWGJYr+pj1KvSUl0H/sDaOXMTHItgAIAAAAASUVORK5CYII="
                            alt="" class="img-fluid"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 col-lg-4 col-12 mb-2">
            <div class="itemstcok">
                <h2>Total observation</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="countnumber">300</h4>
                    <div class="icon_area"><img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAPzSURBVHgB7Vo9TBRBFP5mlh9FOQuNiYk0RhITqEmglgA1AoU0mhhbCL0GeiLWGGi04MAeogUVJNZgjBgbbAly/Agct+P3ZpfLcvwoc3vcLeFL5vZv5vZ989779s1mFQqw1IOa2hpcUxrX9g08VBC8OmR39nGwso3N3mnkotfU4Y4xUD/6UZ9VuIEEoNpg++F7bCoFI8dafoTE95e4nRQSArFVbBbb5dj+rDxFKkkkohDPNH5ARqV74DXX4i4SDH8Pa7oxi3okHCJOOncdVUg4dqiwus5DNRIO5omncUlwRaTScEWk0lBy6eVMpVhGvGAJ0cptM0+l2DKskZZYJaV9jTRigPraj3soERQJ0NghBMaf3AdY5Wa0WEKl84jBGFvvv7uhgZsxkm4wCqNwRElyhEYNqRNI+MAvGr7Iljk2SMb46IAjYifi+5zhIJzyYD5M0fh2LtZaeMdutkc83S3ECoa/1WeE4VmInYhWBSSAAV9hkB66pQ0m2GbY3rDfqiVmjoRTyuTQBwfEToQGd+YPTJjEki8KMzyzYXzM+VQvti8SgsYjEYWFiEVO4RUvER9NCEODobQqRubzRUiJZzxM8a7t1vggL1pzBoP5/wgk+tyIlYiET2T/nY33MF+oSLNVTGZ65JtncJ+k52xHSrTWVoKXw6HlzxEauxH55w5f1CkMGxJrY5iJYg3kFNVLW++JEMxagUB+EjJwQKxEwpkNQMMlbGjoc6tOIgI+Ovl+aZmkhiXcTPhk95SV6vvBsLxnzndvxIioB0JM0uAUVz2PafQsr4+wfWKid9Hi13xrNkADeqNyzf4LcED8T/ZATtvCoxSN/kzjXonRweXg1Y0K8mdY6rDocHp1KofzoyS1Fg2fkdA6ck5qKoVlUTMdEOxCYWJzEqwcOyBWj9jnAkNIDAaOErE1lbFJLSF4DJIv8NxrrViIhDI7YSTBwXiX+DEYhyhTgWdOhPT1mDNFoGgidr3h4yN3myKnM5TitHiG5UgvPdAn65HoOBOsSeShOM5wWkSRKIrIKSQEKSlVRErDdUZaBX1tP6mz7LNEDhRigTORM0jIbC8WxruVZh3MvIsq/Yc9ToPOIrFMCX2GC4YTEUrnCE4n0e07lhnFwInISau/cpIQOBEprIfKTULgWmsN5JeprF7LTULgplqaFSzQYsJDg/Lj6pVppeGKSKXh8hDJbpek9LlQeDlk9Z867CLhqKonkZv7ySfyYB1bunka+xmDbSQU8gmHmkbOJvtsI7YkzpAwyGdP8oWQ3Zef+XmYO0+w27AGVatQgwTAfkwzid+HnzkdW2iaHng/gZvrVaiutK8iqvdwwGne22NeS0pEr/0FVHx3JBEW3qoAAAAASUVORK5CYII="
                            alt="" class="img-fluid"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection