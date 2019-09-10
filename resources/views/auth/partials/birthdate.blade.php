
    <div class="form-row"  {{ old('birth_date[2]') == 'Masculino' ? 'selected' : ''}}>
      <div class="col-3"  {{ old('birth_date[2]') == 'Masculino' ? 'selected' : ''}}>
        <select id="birth_date[]" class="form-control" name="birth_date[]">
          <option selected>DD</option>
          <option value="1" {{ old('birth_date[0]') == '01' || (isset($birthDay) && $birthDay == '01') ? 'selected' : ''}}>1</option>
          <option value="2" {{ old('birth_date[0]') == '02' || (isset($birthDay) && $birthDay == '02')? 'selected' : ''}}>2</option>
          <option value="3" {{ old('birth_date[0]') == '03' || (isset($birthDay) && $birthDay == '03')? 'selected' : ''}}>3</option>
          <option value="4" {{ old('birth_date[0]') == '04' || (isset($birthDay) && $birthDay == '04') ? 'selected' : ''}}>4</option>
          <option value="5" {{ old('birth_date[0]') == '05' || (isset($birthDay) && $birthDay == '05')? 'selected' : ''}}>5</option>
          <option value="6" {{ old('birth_date[0]') == '06' || (isset($birthDay) && $birthDay == '06')? 'selected' : ''}}>6</option>
          <option value="7" {{ old('birth_date[0]') == '07' || (isset($birthDay) && $birthDay == '07')? 'selected' : ''}}>7</option>
          <option value="8" {{ old('birth_date[0]') == '08' || (isset($birthDay) && $birthDay == '08')? 'selected' : ''}}>8</option>
          <option value="9" {{ old('birth_date[0]') == '09'  || (isset($birthDay) && $birthDay == '09') ? 'selected' : ''}}>9</option>
          <option value="10" {{ old('birth_date[0]') == '10' || (isset($birthDay) && $birthDay == '10') ? 'selected' : ''}}>10</option>
          <option value="11" {{ old('birth_date[0]') == '11' || (isset($birthDay) && $birthDay == '11') ? 'selected' : ''}}>11</option>
          <option value="12" {{ old('birth_date[0]') == '12' || (isset($birthDay) && $birthDay == '12')? 'selected' : ''}}>12</option>
          <option value="13" {{ old('birth_date[0]') == '13' || (isset($birthDay) && $birthDay == '13')? 'selected' : ''}}>13</option>
          <option value="14" {{ old('birth_date[0]') == '14' || (isset($birthDay) && $birthDay == '14')? 'selected' : ''}}>14</option>
          <option value="15" {{ old('birth_date[0]') == '15' || (isset($birthDay) && $birthDay == '15')? 'selected' : ''}}>15</option>
          <option value="16" {{ old('birth_date[0]') == '16' || (isset($birthDay) && $birthDay == '16')? 'selected' : ''}}>16</option>
          <option value="17" {{ old('birth_date[0]') == '17' || (isset($birthDay) && $birthDay == '17')? 'selected' : ''}}>17</option>
          <option value="18" {{ old('birth_date[0]') == '18' || (isset($birthDay) && $birthDay == '18')? 'selected' : ''}}>18</option>
          <option value="19" {{ old('birth_date[0]') == '19' || (isset($birthDay) && $birthDay == '19')? 'selected' : ''}}>19</option>
          <option value="20" {{ old('birth_date[0]') == '20' || (isset($birthDay) && $birthDay == '20')? 'selected' : ''}}>20</option>
          <option value="21" {{ old('birth_date[0]') == '21' || (isset($birthDay) && $birthDay == '21')? 'selected' : ''}}>21</option>
          <option value="22" {{ old('birth_date[0]') == '22' || (isset($birthDay) && $birthDay == '22')? 'selected' : ''}}>22</option>
          <option value="23" {{ old('birth_date[0]') == '23' || (isset($birthDay) && $birthDay == '23')? 'selected' : ''}}>23</option>
          <option value="24" {{ old('birth_date[0]') == '24' || (isset($birthDay) && $birthDay == '24')? 'selected' : ''}}>24</option>
          <option value="25" {{ old('birth_date[0]') == '25' || (isset($birthDay) && $birthDay == '25')? 'selected' : ''}}>25</option>
          <option value="26" {{ old('birth_date[0]') == '26' || (isset($birthDay) && $birthDay == '26')? 'selected' : ''}}>26</option>
          <option value="27" {{ old('birth_date[0]') == '27' || (isset($birthDay) && $birthDay == '27')? 'selected' : ''}}>27</option>
          <option value="28" {{ old('birth_date[0]') == '28' || (isset($birthDay) && $birthDay == '28')? 'selected' : ''}}>28</option>
          <option value="29" {{ old('birth_date[0]') == '29' || (isset($birthDay) && $birthDay == '29')? 'selected' : ''}}>29</option>
          <option value="30" {{ old('birth_date[0]') == '30' || (isset($birthDay) && $birthDay == '30')? 'selected' : ''}}>30</option>
          <option value="31" {{ old('birth_date[0]') == '31' || (isset($birthDay) && $birthDay == '31')? 'selected' : ''}}>31</option>
        </select>
      </div>
      <div class="col-5"  {{ old('birth_date[2]') == 'Masculino' ? 'selected' : ''}}>
        <select id="birth_date" class="form-control" name="birth_date[]" >
          <option selected>MM</option>
            <option value="01" {{ old('birth_date[1]') == '01' || (isset($birthMonth) && $birthMonth == '01')? 'selected' : ''}}>enero</option>
            <option value="02" {{ old('birth_date[1]') == '02' || (isset($birthMonth) && $birthMonth == '02')? 'selected' : ''}}>febrero</option>
            <option value="03" {{ old('birth_date[1]') == '03' || (isset($birthMonth) && $birthMonth == '03')? 'selected' : ''}}>marzo</option>
            <option value="04" {{ old('birth_date[1]') == '04' || (isset($birthMonth) && $birthMonth == '04')? 'selected' : ''}}>abril</option>
            <option value="05" {{ old('birth_date[1]') == '05' || (isset($birthMonth) && $birthMonth == '05')? 'selected' : ''}}>mayo</option>
            <option value="06" {{ old('birth_date[1]') == '06' || (isset($birthMonth) && $birthMonth == '06')? 'selected' : ''}}>junio</option>
            <option value="07" {{ old('birth_date[1]') == '07' || (isset($birthMonth) && $birthMonth == '07')? 'selected' : ''}}>julio</option>
            <option value="08" {{ old('birth_date[1]') == '08' || (isset($birthMonth) && $birthMonth == '08')? 'selected' : ''}}>agosto</option>
            <option value="09" {{ old('birth_date[1]') == '09' || (isset($birthMonth) && $birthMonth == '09')? 'selected' : ''}}>septiembre</option>
            <option value="10" {{ old('birth_date[1]') == '10' || (isset($birthMonth) && $birthMonth == '10')? 'selected' : ''}}>octubre</option>
            <option value="11" {{ old('birth_date[1]') == '11' || (isset($birthMonth) && $birthMonth == '11')? 'selected' : ''}}>noviembre</option>
            <option value="12" {{ old('birth_date[1]') == '12' || (isset($birthMonth) && $birthMonth == '12')? 'selected' : ''}}>diciembre</option>
        </select>
      </div>
      <div class="col-4"  {{ old('birth_date[2]') == 'Masculino' ? 'selected' : ''}}>
        <select id="birth_date" class="form-control" name="birth_date[]" >
          <option selected>AAAA</option>
          <option value="2019"  {{ old('birth_date[2]') == '2019' || (isset($birthYear) && $birthYear == '2019') ? 'selected' : ''}}>2019</option>
          <option value="2018"  {{ old('birth_date[2]') == '2018' || (isset($birthYear) && $birthYear == '2018')? 'selected' : ''}}>2018</option>
          <option value="2017"  {{ old('birth_date[2]') == '2017' || (isset($birthYear) && $birthYear == '2017')? 'selected' : ''}}>2017</option>
          <option value="2016"  {{ old('birth_date[2]') == '2016' || (isset($birthYear) && $birthYear == '2016')? 'selected' : ''}}>2016</option>
          <option value="2015"  {{ old('birth_date[2]') == '2015' || (isset($birthYear) && $birthYear == '2015')? 'selected' : ''}}>2015</option>
          <option value="2014"  {{ old('birth_date[2]') == '2014' || (isset($birthYear) && $birthYear == '2014')? 'selected' : ''}}>2014</option>
          <option value="2013"  {{ old('birth_date[2]') == '2013' || (isset($birthYear) && $birthYear == '2013')? 'selected' : ''}}>2013</option>
          <option value="2012"  {{ old('birth_date[2]') == '2012' || (isset($birthYear) && $birthYear == '2012')? 'selected' : ''}}>2012</option>
          <option value="2011"  {{ old('birth_date[2]') == '2011' || (isset($birthYear) && $birthYear == '2011')? 'selected' : ''}}>2011</option>
          <option value="2010"  {{ old('birth_date[2]') == '2010' || (isset($birthYear) && $birthYear == '2010')? 'selected' : ''}}>2010</option>
          <option value="2009"  {{ old('birth_date[2]') == '2009' || (isset($birthYear) && $birthYear == '2009')? 'selected' : ''}}>2009</option>
          <option value="2008"  {{ old('birth_date[2]') == '2008' || (isset($birthYear) && $birthYear == '2008')? 'selected' : ''}}>2008</option>
          <option value="2007"  {{ old('birth_date[2]') == '2007' || (isset($birthYear) && $birthYear == '2007')? 'selected' : ''}}>2007</option>
          <option value="2006"  {{ old('birth_date[2]') == '2006' || (isset($birthYear) && $birthYear == '2006')? 'selected' : ''}}>2006</option>
          <option value="2005"  {{ old('birth_date[2]') == '2005' || (isset($birthYear) && $birthYear == '2005')? 'selected' : ''}}>2005</option>
          <option value="2004"  {{ old('birth_date[2]') == '2004' || (isset($birthYear) && $birthYear == '2004')? 'selected' : ''}}>2004</option>
          <option value="2003"  {{ old('birth_date[2]') == '2003' || (isset($birthYear) && $birthYear == '2003')? 'selected' : ''}}>2003</option>
          <option value="2002"  {{ old('birth_date[2]') == '2002' || (isset($birthYear) && $birthYear == '2002')? 'selected' : ''}}>2002</option>
          <option value="2001"  {{ old('birth_date[2]') == '2001' || (isset($birthYear) && $birthYear == '2001')? 'selected' : ''}}>2001</option>
          <option value="2000"  {{ old('birth_date[2]') == '2000' || (isset($birthYear) && $birthYear == '2000')? 'selected' : ''}}>2000</option>
          <option value="1999"  {{ old('birth_date[2]') == '1999' || (isset($birthYear) && $birthYear == '1999')? 'selected' : ''}}>1999</option>
          <option value="1998"  {{ old('birth_date[2]') == '1998' || (isset($birthYear) && $birthYear == '1998')? 'selected' : ''}}>1998</option>
          <option value="1997"  {{ old('birth_date[2]') == '1997' || (isset($birthYear) && $birthYear == '1997')? 'selected' : ''}}>1997</option>
          <option value="1996"  {{ old('birth_date[2]') == '1996' || (isset($birthYear) && $birthYear == '1996')? 'selected' : ''}}>1996</option>
          <option value="1995"  {{ old('birth_date[2]') == '1995' || (isset($birthYear) && $birthYear == '1995')? 'selected' : ''}}>1995</option>
          <option value="1994"  {{ old('birth_date[2]') == '1994' || (isset($birthYear) && $birthYear == '1994')? 'selected' : ''}}>1994</option>
          <option value="1993"  {{ old('birth_date[2]') == '1993' || (isset($birthYear) && $birthYear == '1993')? 'selected' : ''}}>1993</option>
          <option value="1992"  {{ old('birth_date[2]') == '1992' || (isset($birthYear) && $birthYear == '1992')? 'selected' : ''}}>1992</option>
          <option value="1991"  {{ old('birth_date[2]') == '1991' || (isset($birthYear) && $birthYear == '1991')? 'selected' : ''}}>1991</option>
          <option value="1990"  {{ old('birth_date[2]') == '1990' || (isset($birthYear) && $birthYear == '1990')? 'selected' : ''}}>1990</option>
          <option value="1989"  {{ old('birth_date[2]') == '1989' || (isset($birthYear) && $birthYear == '1989')? 'selected' : ''}}>1989</option>
          <option value="1988"  {{ old('birth_date[2]') == '1988' || (isset($birthYear) && $birthYear == '1988')? 'selected' : ''}}>1988</option>
          <option value="1987"  {{ old('birth_date[2]') == '1987' || (isset($birthYear) && $birthYear == '1987')? 'selected' : ''}}>1987</option>
          <option value="1986"  {{ old('birth_date[2]') == '1986' || (isset($birthYear) && $birthYear == '1986')? 'selected' : ''}}>1986</option>
          <option value="1985"  {{ old('birth_date[2]') == '1985' || (isset($birthYear) && $birthYear == '1985')? 'selected' : ''}}>1985</option>
          <option value="1984"  {{ old('birth_date[2]') == '1984' || (isset($birthYear) && $birthYear == '1984')? 'selected' : ''}}>1984</option>
          <option value="1983"  {{ old('birth_date[2]') == '1983' || (isset($birthYear) && $birthYear == '1983')? 'selected' : ''}}>1983</option>
          <option value="1982"  {{ old('birth_date[2]') == '1982' || (isset($birthYear) && $birthYear == '1982')? 'selected' : ''}}>1982</option>
          <option value="1981"  {{ old('birth_date[2]') == '1981' || (isset($birthYear) && $birthYear == '1981')? 'selected' : ''}}>1981</option>
          <option value="1980"  {{ old('birth_date[2]') == '1980' || (isset($birthYear) && $birthYear == '1980')? 'selected' : ''}}>1980</option>
          <option value="1979"  {{ old('birth_date[2]') == '1979' || (isset($birthYear) && $birthYear == '1979')? 'selected' : ''}}>1979</option>
          <option value="1978"  {{ old('birth_date[2]') == '1978' || (isset($birthYear) && $birthYear == '1978')? 'selected' : ''}}>1978</option>
          <option value="1977"  {{ old('birth_date[2]') == '1977'  || (isset($birthYear) && $birthYear == '1977')? 'selected' : ''}}>1977</option>
          <option value="1976"  {{ old('birth_date[2]') == '1976'  || (isset($birthYear) && $birthYear == '1976')? 'selected' : ''}}>1976</option>
          <option value="1975"  {{ old('birth_date[2]') == '1975'  || (isset($birthYear) && $birthYear == '1975')? 'selected' : ''}}>1975</option>
          <option value="1974"  {{ old('birth_date[2]') == '1974'  || (isset($birthYear) && $birthYear == '1974')? 'selected' : ''}}>1974</option>
          <option value="1973"  {{ old('birth_date[2]') == '1973'  || (isset($birthYear) && $birthYear == '1973')? 'selected' : ''}}>1973</option>
          <option value="1972"  {{ old('birth_date[2]') == '1972'  || (isset($birthYear) && $birthYear == '1972')? 'selected' : ''}}>1972</option>
          <option value="1971"  {{ old('birth_date[2]') == '1971'  || (isset($birthYear) && $birthYear == '1971')? 'selected' : ''}}>1971</option>
          <option value="1970"  {{ old('birth_date[2]') == '1970'  || (isset($birthYear) && $birthYear == '1970')? 'selected' : ''}}>1970</option>
          <option value="1969"  {{ old('birth_date[2]') == '1969' || (isset($birthYear) && $birthYear == '1969')? 'selected' : ''}}>1969</option>
          <option value="1968"  {{ old('birth_date[2]') == '1968' || (isset($birthYear) && $birthYear == '1968')? 'selected' : ''}}>1968</option>
          <option value="1967"  {{ old('birth_date[2]') == '1967' || (isset($birthYear) && $birthYear == '1967')? 'selected' : ''}}>1967</option>
          <option value="1966"  {{ old('birth_date[2]') == '1966' || (isset($birthYear) && $birthYear == '1966')? 'selected' : ''}}>1966</option>
          <option value="1965"  {{ old('birth_date[2]') == '1965' || (isset($birthYear) && $birthYear == '1965')? 'selected' : ''}}>1965</option>
          <option value="1964"  {{ old('birth_date[2]') == '1964' || (isset($birthYear) && $birthYear == '1964')? 'selected' : ''}}>1964</option>
          <option value="1963"  {{ old('birth_date[2]') == '1963' || (isset($birthYear) && $birthYear == '1963')? 'selected' : ''}}>1963</option>
          <option value="1962"  {{ old('birth_date[2]') == '1962' || (isset($birthYear) && $birthYear == '1962')? 'selected' : ''}}>1962</option>
          <option value="1961"  {{ old('birth_date[2]') == '1961' || (isset($birthYear) && $birthYear == '1961')? 'selected' : ''}}>1961</option>
          <option value="1960"  {{ old('birth_date[2]') == '1960' || (isset($birthYear) && $birthYear == '1960')? 'selected' : ''}}>1960</option>
          <option value="1959"  {{ old('birth_date[2]') == '1959' || (isset($birthYear) && $birthYear == '1959')? 'selected' : ''}}>1959</option>
          <option value="1958"  {{ old('birth_date[2]') == '1958' || (isset($birthYear) && $birthYear == '1958')? 'selected' : ''}}>1958</option>
          <option value="1957"  {{ old('birth_date[2]') == '1957' || (isset($birthYear) && $birthYear == '1957')? 'selected' : ''}}>1957</option>
          <option value="1956"  {{ old('birth_date[2]') == '1956' || (isset($birthYear) && $birthYear == '1956')? 'selected' : ''}}>1956</option>
          <option value="1955"  {{ old('birth_date[2]') == '1955' || (isset($birthYear) && $birthYear == '1955')? 'selected' : ''}}>1955</option>
          <option value="1954"  {{ old('birth_date[2]') == '1954' || (isset($birthYear) && $birthYear == '1954')? 'selected' : ''}}>1954</option>
          <option value="1953"  {{ old('birth_date[2]') == '1953' || (isset($birthYear) && $birthYear == '1953')? 'selected' : ''}}>1953</option>
          <option value="1952"  {{ old('birth_date[2]') == '1952' || (isset($birthYear) && $birthYear == '1952')? 'selected' : ''}}>1952</option>
          <option value="1951"  {{ old('birth_date[2]') == '1951' || (isset($birthYear) && $birthYear == '1951')? 'selected' : ''}}>1951</option>
          <option value="1950"  {{ old('birth_date[2]') == '1950' || (isset($birthYear) && $birthYear == '1950')? 'selected' : ''}}>1950</option>
          <option value="1949"  {{ old('birth_date[2]') == '1949' || (isset($birthYear) && $birthYear == '1949')? 'selected' : ''}}>1949</option>
          <option value="1948"  {{ old('birth_date[2]') == '1948' || (isset($birthYear) && $birthYear == '1948')? 'selected' : ''}}>1948</option>
          <option value="1947"  {{ old('birth_date[2]') == '1947' || (isset($birthYear) && $birthYear == '1947')? 'selected' : ''}}>1947</option>
          <option value="1946"  {{ old('birth_date[2]') == '1946' || (isset($birthYear) && $birthYear == '1946')? 'selected' : ''}}>1946</option>
          <option value="1945"  {{ old('birth_date[2]') == '1945' || (isset($birthYear) && $birthYear == '1945')? 'selected' : ''}}>1945</option>
          <option value="1944"  {{ old('birth_date[2]') == '1944' || (isset($birthYear) && $birthYear == '1944')? 'selected' : ''}}>1944</option>
          <option value="1943"  {{ old('birth_date[2]') == '1943' || (isset($birthYear) && $birthYear == '1943')? 'selected' : ''}}>1943</option>
          <option value="1942"  {{ old('birth_date[2]') == '1942' || (isset($birthYear) && $birthYear == '1942')? 'selected' : ''}}>1942</option>
          <option value="1941"  {{ old('birth_date[2]') == '1941' || (isset($birthYear) && $birthYear == '1941')? 'selected' : ''}}>1941</option>
          <option value="1940"  {{ old('birth_date[2]') == '1940' || (isset($birthYear) && $birthYear == '1940')? 'selected' : ''}}>1940</option>
          <option value="1939"  {{ old('birth_date[2]') == '1939' || (isset($birthYear) && $birthYear == '1939')? 'selected' : ''}}>1939</option>
          <option value="1938"  {{ old('birth_date[2]') == '1938' || (isset($birthYear) && $birthYear == '1938')? 'selected' : ''}}>1938</option>
          <option value="1937"  {{ old('birth_date[2]') == '1937' || (isset($birthYear) && $birthYear == '1937')? 'selected' : ''}}>1937</option>
          <option value="1936"  {{ old('birth_date[2]') == '1936' || (isset($birthYear) && $birthYear == '1936')? 'selected' : ''}}>1936</option>
          <option value="1935"  {{ old('birth_date[2]') == '1935' || (isset($birthYear) && $birthYear == '1935')? 'selected' : ''}}>1935</option>
          <option value="1934"  {{ old('birth_date[2]') == '1934' || (isset($birthYear) && $birthYear == '1934')? 'selected' : ''}}>1934</option>
          <option value="1933"  {{ old('birth_date[2]') == '1933' || (isset($birthYear) && $birthYear == '1933')? 'selected' : ''}}>1933</option>
          <option value="1932"  {{ old('birth_date[2]') == '1932' || (isset($birthYear) && $birthYear == '1932')? 'selected' : ''}}>1932</option>
          <option value="1931"  {{ old('birth_date[2]') == '1931' || (isset($birthYear) && $birthYear == '1931')? 'selected' : ''}}>1931</option>
          <option value="1930"  {{ old('birth_date[2]') == '1930' || (isset($birthYear) && $birthYear == '1930')? 'selected' : ''}}>1930</option>
          <option value="1929"  {{ old('birth_date[2]') == '1929' || (isset($birthYear) && $birthYear == '1929')? 'selected' : ''}}>1929</option>
          <option value="1928"  {{ old('birth_date[2]') == '1928' || (isset($birthYear) && $birthYear == '1928')? 'selected' : ''}}>1928</option>
          <option value="1927"  {{ old('birth_date[2]') == '1927' || (isset($birthYear) && $birthYear == '1927')? 'selected' : ''}}>1927</option>
          <option value="1926"  {{ old('birth_date[2]') == '1926' || (isset($birthYear) && $birthYear == '1926')? 'selected' : ''}}>1926</option>
          <option value="1925"  {{ old('birth_date[2]') == '1925' || (isset($birthYear) && $birthYear == '1925')? 'selected' : ''}}>1925</option>
          <option value="1924"  {{ old('birth_date[2]') == '1924' || (isset($birthYear) && $birthYear == '1924')? 'selected' : ''}}>1924</option>
          <option value="1923"  {{ old('birth_date[2]') == '1923' || (isset($birthYear) && $birthYear == '1923')? 'selected' : ''}}>1923</option>
          <option value="1922"  {{ old('birth_date[2]') == '1922' || (isset($birthYear) && $birthYear == '1922')? 'selected' : ''}}>1922</option>
          <option value="1921"  {{ old('birth_date[2]') == '1921' || (isset($birthYear) && $birthYear == '1921')? 'selected' : ''}}>1921</option>
          <option value="1920"  {{ old('birth_date[2]') == '1920' || (isset($birthYear) && $birthYear == '1920')? 'selected' : ''}}>1920</option>
          <option value="1919"  {{ old('birth_date[2]') == '1919' || (isset($birthYear) && $birthYear == '1919')? 'selected' : ''}}>1919</option>
          <option value="1918"  {{ old('birth_date[2]') == '1918' || (isset($birthYear) && $birthYear == '1918')? 'selected' : ''}}>1918</option>
          <option value="1917"  {{ old('birth_date[2]') == '1917' || (isset($birthYear) && $birthYear == '1917')? 'selected' : ''}}>1917</option>
          <option value="1916"  {{ old('birth_date[2]') == '1916' || (isset($birthYear) && $birthYear == '1916')? 'selected' : ''}}>1916</option>
          <option value="1915"  {{ old('birth_date[2]') == '1915' || (isset($birthYear) && $birthYear == '1915')? 'selected' : ''}}>1915</option>
          <option value="1914"  {{ old('birth_date[2]') == '1914' || (isset($birthYear) && $birthYear == '1914')? 'selected' : ''}}>1914</option>
          <option value="1913"  {{ old('birth_date[2]') == '1913' || (isset($birthYear) && $birthYear == '1913')? 'selected' : ''}}>1913</option>
          <option value="1912"  {{ old('birth_date[2]') == '1912' || (isset($birthYear) && $birthYear == '1912')? 'selected' : ''}}>1912</option>
          <option value="1911"  {{ old('birth_date[2]') == '1911' || (isset($birthYear) && $birthYear == '1911')? 'selected' : ''}}>1911</option>
          <option value="1910"  {{ old('birth_date[2]') == '1910' || (isset($birthYear) && $birthYear == '1910')? 'selected' : ''}}>1910</option>
          <option value="1909"  {{ old('birth_date[2]') == '1909' || (isset($birthYear) && $birthYear == '1909')? 'selected' : ''}}>1909</option>
          <option value="1908"  {{ old('birth_date[2]') == '1908' || (isset($birthYear) && $birthYear == '1908')? 'selected' : ''}}>1908</option>
          <option value="1907"  {{ old('birth_date[2]') == '1907' || (isset($birthYear) && $birthYear == '1907')? 'selected' : ''}}>1907</option>
          <option value="1906"  {{ old('birth_date[2]') == '1906' || (isset($birthYear) && $birthYear == '1906')? 'selected' : ''}}>1906</option>
          <option value="1905"  {{ old('birth_date[2]') == '1905' || (isset($birthYear) && $birthYear == '1905')? 'selected' : ''}}>1905</option>
          <option value="1904"  {{ old('birth_date[2]') == '1904' || (isset($birthYear) && $birthYear == '1904')? 'selected' : ''}}>1904</option>
          <option value="1903"  {{ old('birth_date[2]') == '1903' || (isset($birthYear) && $birthYear == '1903')? 'selected' : ''}}>1903</option>
          <option value="1902"  {{ old('birth_date[2]') == '1902' || (isset($birthYear) && $birthYear == '1902')? 'selected' : ''}}>1902</option>
          <option value="1901"  {{ old('birth_date[2]') == '1901' || (isset($birthYear) && $birthYear == '1901')? 'selected' : ''}}>1901</option>
          <option value="1900"  {{ old('birth_date[2]') == '1900' || (isset($birthYear) && $birthYear == '1900')? 'selected' : ''}}>1900</option>
          <option value="1899"  {{ old('birth_date[2]') == '1899' || (isset($birthYear) && $birthYear == '1999')? 'selected' : ''}}>1899</option>
        </select>
      </div>
    </div>
{{--          <input type="text" class="form-control date_input" id="birth_date" name="birth_date" max="{{ date("d/m/Y") }}" placeholder="dd/mm/aaaa" value="{{ old('birth_date') }}"  onblur="(this.type='text')" onfocus="(this.type='date')"  {{ old('birth_date[2]') == 'Masculino' ? 'selected' : ''}}> --}}
