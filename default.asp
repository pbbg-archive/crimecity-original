<%EnableSessionState=True
host = Request.ServerVariables("HTTP_HOST")

if host = "crime-city.co.uk" or host = "www.crime-city.co.uk" then
response.redirect("https://www.crime-city.co.uk/")

else
response.redirect("https://www.crime-city.co.uk/error.htm")

end if
%>
