<?php
use App\Models\Articles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = $bodies = [];

        $titles[] = '四季が起こる要因';
        $bodies[] = <<<__TEXT__
<p>地球は太陽の周りを公転しているが、地軸が約23.4°傾いた状態で公転している。そのため南北の半球ごとに太陽の高さが一番高い位置にあるときと一番低い位置にあるときが生じる。夏至には太陽の高さは北半球で一番高く、南半球では一番低くなる。反対に冬至には太陽の高さは北半球で一番低く、南半球では一番高くなる。</p>
<p>地球はほぼ球体であるから、地球上での位置と公転軌道上の位置によって日照角度と日照時間に違いが出てくる。日照角度とは太陽光が地表に照射する角度のことである。同一の光量の場合、照射角が90°に近いほど面積あたりの受光量は大きくなる。つまり太陽が高く昇るときほど地表は強く暖められる。また、地軸の傾きは日照時間も変化させる。夏至には昼間の時間が最大に、冬至には最小になり、その差は高緯度ほど大きくなる。なお、気温の上下変動は太陽の高さよりも若干遅れて生じるため、真夏は夏至から1か月から2か月、真冬は冬至から1か月から2か月程度の期間となる。</p>
<p style="text-align: right;"><small>Wikipediaより引用<br><a href="https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3">https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3</a></small></p>
__TEXT__;

$titles[] = '気候と四季の関係';
$bodies[] = <<<__TEXT__
<p>世界には四季の変化が顕著で分かりやすい地域と、四季の変化が分かりにくい地域がある。気候の変化は緯度や海陸分布の影響を大きく受けるためである。</p>
<p>中緯度にある温帯や冷帯では、1年の中の気温の変化域が生物活動の変化と対応している部分が多いため、季節変化が感じられやすい。四季が顕著ではっきりと区別できるのは、中緯度にあって、かつ気団の勢力変化が大きい地域（おもに内陸や大陸辺縁部）である。例えば、日本は概ね北緯25度から45度に位置し、小笠原気団（夏）、シベリア気団（冬）、オホーツク海気団（梅雨）、揚子江気団（春・秋）という複数の気団の影響を受ける。</p>
<p>一方、砂漠地帯、熱帯地方、極地などでは一般的に四季の変化が少ない。</p>
<p>赤道を挟む熱帯の地域は気温が年間を通して極端に高く、極地を含む寒帯の地域は気温が年間を通して極端に低いため、1年の中で気温が上下しても生物の活動等に及ぼす変化があまり大きくない。熱帯地域では四季は感じられにくいほか、高緯度の地域では生物の活動に好適な温暖な期間が短い。住民にとっても植生の変化や動物の活動などの季節変化が比較的少なく感じられ、移行期間としての春や秋が区別しがたく、[要出典]夏が無い、あるいは冬が無いとされたりする。</p>
<p>赤道付近では日照時間の変化が小さい上、年間を通して太陽高度が高く、かつ熱帯では気温差の小さい均質な気団が横たわっているため、ほとんど無いに等しい。いわゆる常夏の状態だが、四季とは関係の薄い[要出典]雨季と乾季という季節の変化がみられる地域もある。</p>
<p>極地域、特に北極圏や南極圏では夏には白夜、冬に極夜となり日照時間の変化は非常に激しいが、年間を通して太陽高度が低いため、日照時間で考えるほど気温の変化は大きくない。また、緯度が高くなるにつれて、内陸にあるほど気温変化が大きく海洋に近いほど小さい、という海陸分布の影響を強く受ける傾向がある。</p>
<p>以上は文化的・気候学的な定義であり、天文学的には太陽高度（日照角度）の変化をもとに、地域に関係なく（北半球・南半球の区分はあるが）四季を定義している。</p>
<p style="text-align: right;"><small>Wikipediaより引用<br><a href="https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3">https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3</a></small></p>
__TEXT__;

$titles[] = '北アメリカの四季';
$bodies[] = <<<__TEXT__
<p>北アメリカの気候は極めて多様で、四季性が明確的なものある。富裕で自然資源のある土地を有し、世界一の生物多様性も有しながら、自然災害も頻繁に発生するのは最大の特徴。アメリカ本土の四季によれば、北東部から北にかけて湿潤大陸性気候が占め、春は暖かい・夏は雨が多くて暑い・秋は乾燥で涼しい・冬は結構寒い。この気候影響で果物に育ちやすい自然環境になっている。リンゴ・オレンジ・ブドウ・パイナップル・イチゴ・モモ・スモモ・サクランボ・スイカなど、ほぼ地球中全種類の果物が栽培できる。</p>
<p>東部から中央部は亜寒帯湿潤気候だが、グレートプレーンズ周辺や、カナダと米国の国境部では暑くなる日も多い。エリー湖やオンタリオ湖南岸はアメリカの平野部で最も降雪量が多い。南東部から南部は温暖湿潤気候で、フロリダ南端ではサバナ気候が見られる。西部は一般的に乾燥していてステップ気候が広く見られ、メキシコと米国の国境付近では砂漠気候が確認できる。さらに、太平洋岸南部は地中海性気候だが、太平洋岸北部へ進むとアラスカ南東端と同じく西岸海洋性気候となる。最北部が北極圏に属するアラスカは、年間を通じて冷涼な気候である。一方、太平洋上の諸島であるハワイは温暖な気候で、ビーチリゾートとして人気がある。</p>
<p style="text-align: right;"><small>Wikipediaより引用<br><a href="https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3">https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3</a></small></p>
__TEXT__;

$titles[] = '西欧の四季';
$bodies[] = <<<__TEXT__
<h6>ブリテン諸島</h6>
<p>ブリテン諸島（イギリス全域・アイルランド）の気候は西岸海洋性気候が卓越し、四季を持ちながら全体的な降水量が多く、一年中雨が降る形になっている。冬季、特に風のない日には霧が発生し易く、雪と雨が共に降るのが特徴である。夏季においては熱い雨が人々の体に打ち下り、雨からの火傷の防止策として一年中の傘持ちが常態化している。この傾向が強く当てはまる都市としてロンドンが挙げられ、イギリス紳士の傘文化を生じた理由にもなった。</p>
<p>水の蒸散量が多い夏季に東部が高温になることから、年間を通じて東部が比較的乾燥し、西部が湿潤となる。東部においては、降水量は一年を通じて平均しており、かつ、一日当たりの降水量が少なく、緯度と気温の関連が強くなり、比較的な高温になる。西部においては降水量が2500mmを超えることがある。</p>
<h6>フランス地方</h6>
<p>フランス・ベルギー・ルクセンブルク・オランダの気候は四季性が明らかである。夏30℃以下・冬季0℃の温暖さが多彩な農産物を生み出した。果物以外、花・家具用の木・魚介類・ワイン・チーズ・家畜の肉も高級品満載。特にフランスは大陸性・海洋性・地中海性の三種類の気候が共存していて、このような例はヨーロッパの中でもフランスだけである。この恵まれた四季の御陰で、国土の面積はそれほど大きくないのに、世界第二の農業大国となっている。</p>
<p>フランス国土を東に移動するにつれて気候は大陸性となっていき、気温の年較差、日較差が拡大していくと同時に降水量が上昇していく。本来の大陸性気候はフランス全国より西の限界であるが、フランス東部の高地、特にアルプス山脈の影響によって、大陸性気候が生じている。地中海性気候は国土の南岸で際立つ。気温の年間における変動は3種類の気候区のうち最も大きい。降水量は年間を通じて少ない。</p>
<h6>中欧の四季</h6>
<p>ドイツから始め、オーストリア・スウィーツ・チェコ・スロヴァキア・ハンガリーの四季は比較的に涼しい。冬-5℃以上、夏季は20℃を越えない程度である。だが、降水量には差があり、夏になると降雨は多く、冬になると降雪が多く、春と秋は降水が少ない。他の四季を持っている国と比べると四季性はハッキリしていないが、周辺の植物の変化を観察したらすぐ解る。</p>
<p>ドイツの大部分は温暖な偏西風と北大西洋海流の暖流によって比較的温和である。温かい海流が北海に隣接する地域に影響を与え、北西部および北部の気候は海洋性気候となっている。降雨は年間を通してあり、特に夏季に多い。冬季は温暖で夏季は（30℃を越えることもあるが）冷涼になる傾向がある。東部はより大陸性気候的で、冬季はやや寒冷になる。そして長い乾期がしばしば発生する。中部および南ドイツは過渡的な地域で、海洋性から大陸性まで様々である。国土の大部分を占める海洋性および大陸性気候に加えて、南端にあるアルプス地方と中央ドイツ高地の幾つかの地域は低温と多い降水量に特徴づけられる。</p>
<h6>北欧の四季</h6>
<p>北欧（デンマーク・スウェーデン・ノルウェー・フィンランド・アイスランド）での年中平均温度はほかの地域と比べると全体的に寒い。四季は温度差によって判定では無く、日照時間によって分けている。夏の白夜と冬の極夜が頻発。夏季には22時を過ぎても明るいのに対し、冬季である1月から4月には16時前後になると日が暮れ日没となる。</p>
<h6>南欧の四季</h6>
<p>イタリアが代表する南欧の国々（スペイン・ギリシャ・ポルトガル）は地中海性気候に属し、この気候は冬以外全部熱い。緯度でみるとローマは札幌市などに近いが、一年中顕著的に温暖であり、特に夏になると40℃を超える猛暑が定番である。しかしその反面、イタリアでの冬は寒くなり、-10℃になることもある。降水量において、地中海周辺諸国は、夏に極端的乾燥・冬に極端的湿潤の様なにして、春と秋は平均的なものである。</p>
<p style="text-align: right;"><small>Wikipediaより引用<br><a href="https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3">https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3</a></small></p>
__TEXT__;

$titles[] = '中欧の四季';
$bodies[] = <<<__TEXT__
<p>ドイツから始め、オーストリア・スウィーツ・チェコ・スロヴァキア・ハンガリーの四季は比較的に涼しい。冬-5℃以上、夏季は20℃を越えない程度である。だが、降水量には差があり、夏になると降雨は多く、冬になると降雪が多く、春と秋は降水が少ない。他の四季を持っている国と比べると四季性はハッキリしていないが、周辺の植物の変化を観察したらすぐ解る。</p>
<p>ドイツの大部分は温暖な偏西風と北大西洋海流の暖流によって比較的温和である。温かい海流が北海に隣接する地域に影響を与え、北西部および北部の気候は海洋性気候となっている。降雨は年間を通してあり、特に夏季に多い。冬季は温暖で夏季は（30℃を越えることもあるが）冷涼になる傾向がある。東部はより大陸性気候的で、冬季はやや寒冷になる。そして長い乾期がしばしば発生する。中部および南ドイツは過渡的な地域で、海洋性から大陸性まで様々である。国土の大部分を占める海洋性および大陸性気候に加えて、南端にあるアルプス地方と中央ドイツ高地の幾つかの地域は低温と多い降水量に特徴づけられる。</p>
<p style="text-align: right;"><small>Wikipediaより引用<br><a href="https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3">https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3</a></small></p>
__TEXT__;

$titles[] = '北欧の四季';
$bodies[] = <<<__TEXT__
<p>北欧（デンマーク・スウェーデン・ノルウェー・フィンランド・アイスランド）での年中平均温度はほかの地域と比べると全体的に寒い。四季は温度差によって判定では無く、日照時間によって分けている。夏の白夜と冬の極夜が頻発。夏季には22時を過ぎても明るいのに対し、冬季である1月から4月には16時前後になると日が暮れ日没となる。</p>
<p style="text-align: right;"><small>Wikipediaより引用<br><a href="https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3">https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3</a></small></p>
__TEXT__;

$titles[] = '南欧の四季';
$bodies[] = <<<__TEXT__
<p>イタリアが代表する南欧の国々（スペイン・ギリシャ・ポルトガル）は地中海性気候に属し、この気候は冬以外全部熱い。緯度でみるとローマは札幌市などに近いが、一年中顕著的に温暖であり、特に夏になると40℃を超える猛暑が定番である。しかしその反面、イタリアでの冬は寒くなり、-10℃になることもある。降水量において、地中海周辺諸国は、夏に極端的乾燥・冬に極端的湿潤の様なにして、春と秋は平均的なものである。</p>
<p style="text-align: right;"><small>Wikipediaより引用<br><a href="https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3">https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3</a></small></p>
__TEXT__;

$titles[] = 'オセアニアの四季';
$bodies[] = <<<__TEXT__
<h6>オーストラリア</h6>
<p>オーストラリア大陸は広大で、気候に地域差があって 全体的に大陸北部は熱帯気候・大陸南部は温帯気候・全域は海洋性気候に囲まれているため、四季が明確性持ちの特徴になっている。南半球に位置しているため、一般には11月から1月が春、2月から4月が夏、5月から8月が秋、9月から10月が冬となる。南部地域では冬でも温暖な日が多いがニューサウスウェールズ州がある地域の山岳部では積雪がみられる。オーストラリアでは年間を通して暑い気候であり、1月から3月には雨季があって、内陸部は日の気温差が大きい砂漠地帯となっている。</p>
<h6>ニュージーランド諸島</h6>
<p>ニュージーランドは日本と同じ島国で、南半球に位置する。この影響で四季が日本と正反対である。</p>
<p style="text-align: right;"><small>Wikipediaより引用<br><a href="https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3">https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3</a></small></p>
__TEXT__;

$titles[] = '極東地域の四季';
$bodies[] = <<<__TEXT__
<h6>中国大陸の四季</h6>
<p>詳細は「二十四節気」を参照</p>
<p>中国大陸にもはっきりとした四季があり、四季・季節・春夏秋冬等の漢字を発明した本家である。単純な「四季」より、中国はもっと細かい「二十四節気」が使用している。この二十四節気は宋王朝の時から日本に伝わり、今の日本でも使われている。中国大陸は名の通りに大陸性気候を基準として、季風気候・砂漠気候・寒帯気候を加えたものである。今から3000年前の『春秋左氏伝』から始め、僖公5年の「分至啓閉」という語の「啓」が立春・立夏、「閉」が立秋・立冬と考えられており、『呂氏春秋』において「立春・立夏・立秋・立冬」の語が使われていることから、戦国時代に一般化したと考えられる。立秋の時期までが暑さのピークであり、立春までの時期が寒さのピークとなる。</p>
<p>なお、古代中国人は一年12か月を春・夏・秋・冬の四時に分け、正月（一月）・二月・三月を春、四月・五月・六月を夏、七月・八月・九月を秋、十月・十一月・十二月を冬とした。2400年前の周では、中国の「二十四節気」が定着化した。冬至を基準に年始が置かれていたが、戦国時代になると冬至の翌々月を年始とする夏正（夏暦）が各国で採用されるようになり、これにより冬至と春分の中間点が正月すなわち春の最初の節気にあたるようになったことで「立春」と名付けられ、他の二至二分四立も春夏秋冬の名が冠せられるようになったと考えられる。</p>
<h6>台湾の四季</h6>
<p>台湾は中央部と北部が亜熱帯、南部が熱帯に属している。そのため、北部は夏季を除けば比較的気温が低く四季がハッキリしていて、南部は冬季を除けば気温が30度（摂氏）を超えることが多くて四季が不明瞭である。台湾の夏はおおよそ9月から11月までで、通常は蒸し暑く、日中の気温は27度から35度まで上り、10月の平均気温は28度である。台風の襲来が圧倒的に多く、毎年平均3 - 4個の台風に襲われる。平均降雨量は年間およそ2,515mmであり、雨期に多く、また降雨量は季節・位置・標高によって大きく異なっている。</p>
<h6>朝鮮半島の四季</h6>
<p>朝鮮半島に位置しているものの顕著な大陸性気候・海洋性気候の融合であり、諸外国の中で日本の四季に一番近いものである。半島にも梅雨（朝鮮語で「チャンマ」）があり、寒暖の差が激しく気温の年較差・日較差が大きい。夏はやや湿潤である。ソウルの夏の気温は30度を超えることもよくあり、また内陸の盆地にある大邱は韓国で最も暑いとされるが、湿気が少なく、また熱帯夜になる事はほとんどない。</p>
<p>冬は大陸からの冷たく乾燥した季節風の影響を受け寒冷であるが非常に乾燥し積雪は少ない。例えばソウルは新潟県長岡市付近と同緯度にあるが、1月の平均気温は-2.4度で、冬には、強烈なシベリア寒気団に覆われると、ソウルでも最低気温が-10〜-15度前後になり、郊外では-15度を下回ることもある。また、釜山の1月の平均気温は3.2度である。ケッペンの気候区分によると、ソウル、春川、堤川などの北部や内陸部、山岳地帯は亜寒帯冬季少雨気候、それ以外の地域は温帯夏雨気候および温暖湿潤気候に属する。</p>
<p style="text-align: right;"><small>Wikipediaより引用<br><a href="https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3">https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3</a></small></p>
__TEXT__;

$titles[] = '日本列島の四季';
$bodies[] = <<<__TEXT__
<p>「日本の気候#季節」も参照</p>
<h6>日本の春</h6>
<p>日本列島では3月上旬頃までは北日本や山間部を中心に余寒（よかん）と呼ばれる冬の寒さが残り、まだ降雪と積雪や路面凍結も残る。初春の3月中旬から気温は急激に上がり北日本と山間部を除いて、気温は16～20℃まで上がる日が増え、暖かくなる。[要出典]冬枯れの雑草が緑色に変色し若草が生え、樹木に新芽が出始める。 また冬の各季節現象が終わりを告げ、雪が完全に止む終雪、霜が降りなくなる終霜、氷が張らなくなる終氷の時期ともなり、春の訪れを感じさせるようになる。ただし、年によっては寒気の南下や南岸低気圧の影響で季節外れの遅い降雪や凍結になることがある。また、北日本や北信越地方を中心に春分以降も寒の戻り等で降雪が観測される年もある。そして、3月後半には南日本からサクラの花が咲き始める。春本番の仲春から晩春の4月から5月前半にかけてはチューリップ、ツツジ、フジ等といった多種多様な春の花が咲き始め、樹木・雑草が緑で青々とし始める新緑の時期となる。</p>
<h6>日本の夏</h6>
<p>日本列島の夏は湿度が高く蒸し暑い。日中の気温はおおむね30～35℃程度だが、湿度が高いため体感気温は高い。なお、湿度が高い理由は太平洋高気圧によるもので、太平洋上から蒸発した水蒸気が高気圧に混じり高湿度の状態で日本列島をすっぽり覆うために起こる。近年では7月になると猛暑日と呼ばれる最高気温が35℃以上の日がある。内陸部でフェーン現象が起こると40℃以上の危険な暑さになることもある。一方で北海道や東北北部の太平洋沿岸部(三陸海岸以北)にはしばしば冷たく湿ったやませが吹き付ける。</p>
<p>夏は次の四つの節に分けられる。</p>
<p>初夏</p>
<p>5月中旬から梅雨入りするまでは初夏と呼ばれる。気温は24～30℃、湿度は盛夏ほど高くなく過ごしやすいと言える。初夏になると植物は繁茂し始め、動物類は餌を求め活発に動き回るようになる。</p>
<p>梅雨</p>
<p>6月ごろ、本州島以南の島々での雨季。平均して6月中頃から7月中頃まで約1か月程続く。梅雨の後期はしばしば豪雨となる。同時期、北海道はやませの影響もあり梅雨は不明瞭であり、かつては6月は比較的雨が少ない時期であった。ところが近年では降雨量が増え豪雨が降ることさえある。</p>
<p>盛夏</p>
<p>この時期、気温は東北地方中部以南の地域では35℃以上の猛暑日になることも多い。盛夏は8月中旬頃を境に晩夏へと移行する。なお、近年の日本列島では8月を過ぎても暑さが緩まず猛暑日になることがしばしばである。</p>
<p>晩夏</p>
<p>8月下旬から9月上旬頃までとされている場合も多い。</p>
<h6>日本の秋</h6>
<p>日本列島では9月上旬頃[要出典]まで残暑（ざんしょ）と呼ばれる夏の暑さがまだ残り、まだ真夏日・猛暑日・熱帯夜も残る。9月中旬頃になると気温と湿度が下がりはじめ、初秋となる。この時期は、大きな台風が上陸しやすい季節でもあり、10月初め頃まで台風が上陸することがある。9月下旬から11月上旬にかけては秋本番の仲秋で、涼やかな季節である。</p>
<p>11月になると朝の冷え込みが一段と厳しくなり北日本から次第に紅葉の季節となる。日本列島の紅葉はカエデ・ハゼなどの赤く染まる落葉樹が多いのが特徴で、色とりどりの鮮やかな紅葉を見せる。</p>
<p>11月も中旬になり「晩秋」の時期になると、北日本や日本海側・山間部や内陸部では冬の訪れが早く、最低気温が初めて氷点下まで下がり初雪が降り始める。落葉樹の樹木は紅葉が見ごろを過ぎて落葉し始め、荒涼とした枯れ枝のみの茶色い冬枯れになる。動物や虫類が冬眠に入るようになる。また、関東以西でも西日本の太平洋側と南西諸島を除く太平洋側の地域にその冬初めて氷が張り、この時期に霜が降り始める。</p>
<h6>日本の冬</h6>
<p>冬は日本海側から冷たく湿った風が吹きつけ、北日本はほぼ毎日気温が0℃以下の冬日や真冬日になる。北日本の日本海側は世界屈指の豪雪地帯であり、多いところで2～3mもの雪が積もる。一方、関東以西の太平洋側では、山間部や内陸を除くと冬は比較的穏やかで、沿岸部では積雪がないことが多く、気温もそれほど低くはならない。空気も乾燥しており、晴れた日も多い。</p>
<p>12月に入ると東海地方以西の太平洋側では初雪が降る。</p>
<p>1月から2月初め頃までは、一年で最も寒い時期の「真冬」となる。寒さのピークであり、大陸から寒波が断続的に流れ込み、日本海側や北日本では大雪の日が多い。北日本や山間部では最高気温0℃以下の真冬日が多くなり、特に北海道内陸部は-20℃未満の極寒に見舞われることがある。太平洋側の平地でもこの時期の最高気温は4～10℃と寒く、冷たく乾燥したからっ風が吹くため体感温度はさらに低い。</p>
<p>2月になると北日本でも真冬日が減り、日平均気温は太平洋側平野部では6℃前後、厳しい寒さだった真冬に比べると寒さは和らぐ。そして南日本では梅が開花し、南寄りの風が吹き荒れる。一方で、東北から関東地方にかけての太平洋側は降雪が最も多い時期でもあり、この時期に多く発生する南岸低気圧によって雪を降らせている。</p>
<p style="text-align: right;"><small>Wikipediaより引用<br><a href="https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3">https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3</a></small></p>
__TEXT__;

$titles[] = '四季をテーマにした作品';
$bodies[] = <<<__TEXT__
<h6>音楽</h6>
<p>「Category:四季を題材とした楽曲」を参照</p>
<ul>
<li>四季 (ヴィヴァルディ)（1725年、イタリア）</li>
<li>四季 (ハイドン)（1800年、オーストリア）</li>
<li>四季 (チャイコフスキー)（1885年、ロシア）</li>
<li>四季 (グラズノフ)（1899年、イタリア）</li>
<li>四季 (w-inds.の曲)（2004年、日本）</li>
</ul>
<h6>文学</h6>
<ul>
<li>日本の小説家有栖川有栖の競作小説『まほろ市の殺人』、春・夏・秋・冬の4作から成っている。</li>
</ul>
<h6>映画</h6>
<ul>
<li>フランスの映画人エリック・ロメールの連作、春のソナタ（1990年）・冬物語（1992年）・夏物語（1996年）・恋の秋（1998年）の4部を創作した。</li>
</ul>
<h6>テレビドラマ</h6>
<ul>
<li>韓国のドラマ監督ユン・ソクホの連作、秋の童話（2000年）・冬のソナタ（2002年）・夏の香り（2003年）・春のワルツ（2006年）の4部を創作した。</li>
</ul>
<p style="text-align: right;"><small>Wikipediaより引用<br><a href="https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3">https://ja.wikipedia.org/wiki/%E5%9B%9B%E5%AD%A3</a></small></p>
__TEXT__;


        DB::table('articles')->truncate();

        $articles = [];
        for ($i = 0; $i < count($titles); $i++) {
            $articles[] = [
                'user_id' => 1,
                'type' => Articles::TYPE_MEMBER_ARTICLE,
                'status' => \Status::ENABLED,
                'title' => $titles[$i],
                'body' => $bodies[$i],
                'created_at' => carbon()->addDays(-30 + $i)->copy(),
                'updated_at' => null,
                'deleted_at' => null,
            ];
        }

        foreach ($articles as $value) {
            Articles::query()->create($value);
        }
    }
}