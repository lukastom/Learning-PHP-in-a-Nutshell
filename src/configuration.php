<?php

/*Return outside of function
  • Execution of the current script file is ended.
  • If the current script file was included or required, then control is passed back to the calling file.
  • If the current script file was included, then the value given to return will be returned as the value of the include call*/
return 5;