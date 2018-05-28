start
  = summand:summand ' '* { return Boolean(summand); }
  / '' {return true;}

summand
  = left:faktor " | " right:summand { return left || right; }
  / faktor

faktor
  = left:token ' ' right:faktor { return left && right; }
  / assembly

assembly
  = token
  / "(" summand:summand ")" { return summand; }

token "token"
  = text
  / type
  / color
  / payable
  / name

name "name"
  =      '"' name:([a-zA-Z ]+) '"' {return options.name.match(new RegExp(name.join(''), 'gi'));}
  /      name:[a-zA-Z]+            {return options.name.match(new RegExp(name.join(''), 'gi'));}

type "type"
  = typePrefix ':' '"' type:([a-zA-Z ]+) '"' {return options.type.match(new RegExp(type.join(''), 'gi'));}
  / typePrefix '!' '"' type:([a-zA-Z ]+) '"' {return !options.type.match(new RegExp(type.join(''), 'gi'));}
  / typePrefix '!'     type:[a-zA-Z]+        {return !options.type.match(new RegExp(type.join(''), 'gi'));}
  / typePrefix ':'     type:[a-zA-Z]+        {return options.type.match(new RegExp(type.join(''), 'gi'));}

typePrefix
  = 'type' / 't'

color "color"
  = colorPrefix ':m'                          {
  				       if(typeof options.meta.colors != 'undefined')
                                      	 if(options.meta.colors.length > 1)
                                            return true;
  				   }

  / colorPrefix ':' color:[wurbg]+            {
                                      for(var i=0; i<color.length; i++){
                                        if(_.includes(options.meta.colors, peg_color(color[i])))
                                        	return true;
                                      }
                                   }

  / colorPrefix ':' '"' color:[wurbg]+ '"'    {
                                      ret = true;
                                      for(var i=0; i<color.length; i++){
                                        if(!_.includes(options.meta.colors, peg_color(color[i])))
                                        	ret = false;
                                      }
                                      return ret;
                                   }

colorPrefix
  = 'color' / 'c'

payable "payable"
  = payablePrefix ':c' ressource:[wurbg]+       {
  				       if((typeof options.manaCost != 'undefined') && (typeof options.meta.colors != 'undefined'))
                                         return peg_canPay(options.manaCost, ressource.map(function(res){
                                           return res.toUpperCase();
                                         }));
  				   }

  / payablePrefix ':' ressource:[wurbg]+        {
  				       if(typeof options.manaCost != 'undefined')
                                         return peg_canPay(options.manaCost, ressource.map(function(res){
                                           return res.toUpperCase();
                                         }));
  				   }

payablePrefix
  = 'pay' / 'p'

text "text"
  = textPrefix ':' '"' text:([a-zA-Z0-9 \-\/\+\:\{\}]+) '"' {return options.text.match(new RegExp(text.join(''), 'gi'));}
  / textPrefix ':'     text:[a-zA-Z0-9\-\/\+\:\{\}]+        {return options.text.match(new RegExp(text.join(''), 'gi'));}

textPrefix
  = 'text' / 'o'