
<HTML>
<HEAD>
<TITLE>DHTML Tip Message version 1</TITLE>
</HEAD>
<body topmargin="15" leftmargin="15" >

<DIV id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-100"></DIV>

<SCRIPT language="JavaScript1.2" type="text/javascript" src="TipMessage.js"></SCRIPT>

<SCRIPT language="JavaScript1.2" type="text/javascript">
	var tp_Style=[],Text=[]
	tp_Style[0]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,10,51,1,0,"",""]
	tp_Style[1]=["white","black","#000099","#E8E8FF","","","","","","","center","","","",200,"",2,2,10,10,"","","","",""]
	tp_Style[2]=["white","black","#000099","#E8E8FF","","","","","","","left","","","",200,"",2,2,10,10,"","","","",""]
	tp_Style[3]=["white","black","#000099","#E8E8FF","","","","","","","float","","","",200,"",2,2,10,10,"","","","",""]
	tp_Style[4]=["white","black","#000099","#E8E8FF","","","","","","","fixed","","","",200,"",2,2,1,1,"","","","",""]
	tp_Style[5]=["white","black","#000099","#E8E8FF","","","","","","","","sticky","","",200,"",2,2,10,10,"","","","",""]
	tp_Style[6]=["white","black","#000099","#E8E8FF","","","","","","","","keep","","",200,"",2,2,10,10,"","","","",""]
	tp_Style[7]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,40,10,"","","","",""]
	tp_Style[8]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,50,"","","","",""]
	tp_Style[9]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,10,51,0.5,75,"simple","gray"]
	tp_Style[10]=["white","black","black","white","","","right","","Impact","cursive","center","",3,5,200,150,5,20,10,0,50,1,80,"complex","gray"]
	tp_Style[11]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,10,51,0.5,45,"simple","gray"]
	tp_Style[12]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,10,"","","","",""]

	tp_Style[13]=["white","black","#9c0000","#F0D2C8","","","","","","","float","","","",200,"",2,2,10,10,51,0.5,0,"complex","#999999"]

tp_applyCssFilter()

	Text[0]=["Me Email","Click here to send me an email "]
	Text[1]=["Home Page","Click here to go to my Web site."]
	Text[2]=["This is the title","Well How do you find this Tip message to be?"]
	Text[3]=["Right","This tip Is right positioned"]
	Text[4]=["Center","This tip Is center positioned"]
	Text[5]=["Left","This tip Is left positioned"]
	Text[6]=["Float","This tip Is float positioned at a (10,10) coordinate, It also floats with the scrollbars so it is always static"]
	Text[7]=["Fixed","This tip Is fixed positioned at a (1,1) coordinate"]
	Text[8]=["sticky style","This tip will sticky around<BR>This is useful when you want to insert a link like this <A href='http://migoicons.tripod.com'>Home Page</A>"]
	Text[9]=["keep style","This sticks around the mouse"]
	Text[10]=["Left coordinate control","This tip is right positioned with a 40 X coordinate "]
	Text[11]=["Top coordinate control","This tip is right positioned with a 50 Y coordinate"]
	Text[12]=["Visual effects","<img src=classeFormsHelp.gif width=19 height=19>This tip has a Shadow and is Transparent a little and also has a random Transition applied to it "]
	Text[13]=["different style","Wow this is a new style and position! "]
	Text[14]=["This is The title","this is the text"]
	Text[15]=["","This is only text"]
	
	Text[16]=["","<img src=classeFormsHelp.gif width=19 height=19>Some Lists <li>list one</li> <li>list two</li> <li>list three</li> <li>list four</li>"]
</script>

<img src="classeFormsHelp.gif" width="19" height="19"><BR>
<BR>
<form name="form1" method="post" action="">
  <select name="select">
    <option value="a">az</option>
    <option value="1">azazeaze</option>
  </select>
</form>
<BR>
<P>Their are so many things you can to with this dhtml tip message, here are 
just some of the things. For more templates and information visit my web site .</P>

<P>You may set a 
<A href="#" onMouseOver="tp_stm(Text[14],tp_Style[12])" onMouseOut="tp_htm()">title</a> for your tip and you 
<A href="#" onMouseOver="tp_stm(Text[15],tp_Style[12])" onMouseOut="tp_htm()">may not</a>. You can position your tip as <A href="#" onMouseOver="tp_stm(Text[3],tp_Style[12])" onMouseOut="tp_htm()">Right</A> which is the default, or <A href="#" onMouseOut="tp_htm()" onMouseOver="tp_stm(Text[4],tp_Style[1])">center</A> or <A href="#" onMouseOver="tp_stm(Text[5],tp_Style[2])" onmouseout="tp_htm()">left</A> or
<A href="#" onMouseOver="tp_stm(Text[6],tp_Style[3])" onMouseOut="tp_htm()">float </A>or 
<A href="#" onMouseOver="tp_stm(Text[7],tp_Style[4])" onMouseOut="tp_htm()">fixed</A> (You many need to scroll up to see this). You also 
can make 
your tip 
<A href="#" onMouseOver="tp_stm(Text[8],tp_Style[5])" onmouseout="tp_htm()">sticky</A> 
with a close link or 
<A href="#"  onMouseOver="tp_stm(Text[9],tp_Style[6])" onMouseOut="tp_htm()">keep</A> it moving with the mouse around the page.<BR> 
You may also 
control the <A href="#" onMouseOut="tp_htm()" onMouseOver="tp_stm(Text[10],tp_Style[7])">left</A> and the <A onMouseOver="tp_stm(Text[11],tp_Style[8])" href="#" onMouseOut="tp_htm()">top</A> coordinates of the message from the mouse. You many also 
add 
<A href="#" onMouseOver="tp_stm(Text[12],tp_Style[9])" onmouseout="tp_htm()">visual effects</A> to the tip message in MSIE 5.5 or later. 
You can change the 
<A href="#" onMouseOver="tp_stm(Text[13],tp_Style[10])" onMouseOut="tp_htm()">hole tp_Style</A> for every tip message 
by using different style arrays in the tp_stm function. You also may 
insert <A href="#" onMouseOver="tp_stm(Text[16],tp_Style[12])" onMouseOut="tp_htm()"> any html tags you want</A>.</P>
<A href="#" onMouseOver="tp_stm(Text[12],tp_Style[13])" onMouseOut="tp_htm()"> perso </A>.
</BODY>
</HTML>