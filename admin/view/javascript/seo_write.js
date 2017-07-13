function erase(keyword)
{
	var len = keyword.length;
	var str = '', c;
	for(i=0; i < len; i++)
	{
		c = keyword.charCodeAt(i);
		if(( c>= 192 && c <= 195) || ( c>= 224 && c <= 227) || c==258 || c==259 || ( c>= 461 && c <= 7863))
		{
			str+='a';
		}else
			if(c==272 || c==273 )
			{
				str+='d';
			}else
				if((c>=200 && c<=202) || (c>=232 && c<=234) || ( c>= 7864 && c <= 7879))
				{
					str+='e';
				}else
					if(c==204 || c==205 ||c==236 || c==237 ||c==296 || c==297 || ( c>= 7880 && c <= 7883))
					{
						str+='i';
					}else
						if(c==217 || c==218 || c==249 || c==250 || c==360 || c==361 || c==431 || c==432 || ( c>= 7908 && c <= 7921))
						{
							str+='u';
						}else
							if((c>=210 && c<=213) || (c>=242 && c<=245) || c==416 || c==417 || ( c>= 7884 && c <= 7907))
							{
								str+='o';
							} else
								if(c==221 || c==253 || (c>= 7922 && c <= 7929))
								{
									str+='y';
								} else
									str+= keyword.charAt(i);
	}
	return str;
}

function trim12 (str) {
    var    str = str.replace(/^\s\s*/, ''),
        ws = /\s/,
        i = str.length;
    while (ws.test(str.charAt(--i)));
    return str.slice(0, i + 1);
}

function seo_write(keyword){
	var replace = new Array(" ", "---", "--", " - ", ",", "/", " / ", "_");
	var by = "-";
	var remove = new Array("&","\"","\'","!","$","#","%","|",",");
	keyword = trim12(keyword);
	for (var i=0; i<remove.length; i++) { 
		keyword = keyword.replace( new RegExp(remove[i], "g"),""); 
	}
	for (var i=0; i<replace.length; i++) { 
     keyword = keyword.replace(new RegExp(replace[i], "g"), by); 
	}
    
	return keyword.toLowerCase();
}