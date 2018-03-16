<?php
$order_page = isset($_GET['orders_page']) ? $_GET['orders_page'] : '';
?>
<ul class="side-menu-icons">
    <li <?php bl_active($order_page,'new')?>>
        <a class="side-menu-icon" href="/orders?orders_page=new">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20">
                <path d="M373.667,358H382a0.334,0.334,0,0,0,0-.667h-8.333A0.334,0.334,0,1,0,373.667,358Zm0-2.667H377a0.333,0.333,0,0,0,0-.666h-3.333A0.333,0.333,0,1,0,373.667,355.333Zm0,5.334H382a0.334,0.334,0,0,0,0-.667h-8.333A0.334,0.334,0,1,0,373.667,360.667Zm5.666,2h-5.666a0.333,0.333,0,1,0,0,.666h5.666A0.333,0.333,0,1,0,379.333,362.667Zm-1,2.666h-4.666a0.334,0.334,0,1,0,0,.667h4.666A0.334,0.334,0,1,0,378.333,365.333Zm7.334-3.879v-6.592L380.805,350H370v20h14.667A4.331,4.331,0,0,0,385.667,361.454ZM381,351.138l3.529,3.529H381v-3.529Zm1.359,18.2H370.667V350.667h9.666v4.666H385v6.015q-0.171-.015-0.333-0.015a4.339,4.339,0,0,0-4.334,4.334c0,0.133.009,0.264,0.02,0.394l0.009,0.091c0.015,0.127.033,0.253,0.058,0.377,0,0.014.007,0.029,0.01,0.043,0.024,0.113.053,0.224,0.086,0.333l0.024,0.082c0.038,0.117.08,0.233,0.127,0.346L380.7,367.4c0.043,0.1.09,0.195,0.14,0.289l0.035,0.069c0.059,0.1.121,0.208,0.188,0.309l0.047,0.067c0.061,0.088.125,0.174,0.192,0.257l0.038,0.048q0.115,0.138.243,0.267c0.02,0.021.041,0.041,0.063,0.062,0.081,0.079.165,0.157,0.253,0.23l0.023,0.02c0.094,0.077.192,0.149,0.293,0.219l0.073,0.05C382.309,369.3,382.334,369.317,382.359,369.333Zm2.308,0a3.667,3.667,0,1,1,0-7.333c0.1,0,.206.007,0.308,0.016s0.2,0.022.3,0.039l0.148,0.025A3.666,3.666,0,0,1,384.667,369.333Zm2-4H385v-1.666a0.334,0.334,0,1,0-.667,0v1.666h-1.666a0.334,0.334,0,1,0,0,.667h1.666v1.667a0.334,0.334,0,0,0,.667,0V366h1.667A0.334,0.334,0,0,0,386.667,365.333Z" transform="translate(-370 -350)"/>
            </svg>
        </a>
    </li>
    <li <?php bl_active($order_page,'draft')?>>
        <a class="side-menu-icon" href="/orders?orders_page=draft">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <path d="M388.976,403H371.05a1.038,1.038,0,0,0-1.05,1.025v12.508a1.038,1.038,0,0,0,1.025,1.05h0.641V416.75h-0.633a0.2,0.2,0,0,1-.2-0.2v-12.5a0.2,0.2,0,0,1,.183-0.216H388.95a0.2,0.2,0,0,1,.2.2v12.5a0.2,0.2,0,0,1-.2.2h-1.866v0.834h1.883A1.038,1.038,0,0,0,390,416.55v-12.5A1.037,1.037,0,0,0,388.976,403Zm-11.059,13.75h3.333v0.833h-3.333V416.75Zm-2.084-10.417H373.75a1.25,1.25,0,0,0-1.25,1.25V421.75a1.25,1.25,0,0,0,1.25,1.25h2.083a1.25,1.25,0,0,0,1.25-1.25V407.583A1.25,1.25,0,0,0,375.833,406.333Zm0.417,15.417a0.417,0.417,0,0,1-.417.417H373.75a0.417,0.417,0,0,1-.417-0.417v-0.417h1.25V420.5h-1.25V418h1.25v-0.833h-1.25v-2.084h1.25V414.25h-1.25v-2.5h1.25v-0.834h-1.25v-2.083h1.25V408h-1.25v-0.417a0.417,0.417,0,0,1,.417-0.417h2.083a0.417,0.417,0,0,1,.417.417V421.75h0Zm6.538-7.833a0.409,0.409,0,0,0-.15-0.092l-0.055-.029-2.083-.834a0.418,0.418,0,0,0-.542.232,0.425,0.425,0,0,0,0,.31l0.834,2.083a1.87,1.87,0,0,0,.125.2l7.05,7.046a0.417,0.417,0,0,0,.587,0l1.284-1.284a0.417,0.417,0,0,0,0-.587Zm-1.459.77-0.237-.6,0.6,0.238ZM381.8,415.5l0.7-.7,5.417,5.417-0.7.7Zm6.463,6.454-0.458-.454,0.691-.692,0.454,0.454Zm0.071-16.871a0.417,0.417,0,0,0-.417-0.417H386.25V405.5h1.25v1.25h0.834v-1.667h0Zm-0.834,2.5h0.834v0.833H387.5v-0.833Z" transform="translate(-370 -403)"/>
            </svg>
        </a>
    </li>
    <li <?php bl_active($order_page,'inwork')?>>
        <a class="side-menu-icon" href="/orders?orders_page=inwork">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <path d="M378.945,458.577v-1.52A1.054,1.054,0,0,1,380,456h0a1.055,1.055,0,0,1,1.054,1.053h0v1.52A1.056,1.056,0,0,1,380,459.633h0a1.056,1.056,0,0,1-1.053-1.056h0Zm0,16.362v-1.518A1.056,1.056,0,0,1,380,472.366h0a1.056,1.056,0,0,1,1.054,1.055h0v1.518A1.057,1.057,0,0,1,380,476h0a1.056,1.056,0,0,1-1.053-1.057h0ZM384.5,461.5a1.057,1.057,0,0,1,0-1.491h0l1.074-1.074a1.053,1.053,0,0,1,1.492,0h0a1.048,1.048,0,0,1,0,1.488h0l-1.075,1.077a1.06,1.06,0,0,1-.745.307h0a1.062,1.062,0,0,1-.746-0.307h0Zm-11.571,11.569a1.059,1.059,0,0,1,0-1.492h0l1.074-1.073a1.06,1.06,0,0,1,1.493,0h0a1.059,1.059,0,0,1,0,1.492h0l-1.076,1.073a1.047,1.047,0,0,1-.746.308h0a1.048,1.048,0,0,1-.745-0.308h0Zm14.491-6.014A1.053,1.053,0,0,1,386.368,466h0a1.053,1.053,0,0,1,1.054-1.054h1.519A1.056,1.056,0,0,1,390,466h0a1.055,1.055,0,0,1-1.055,1.054h-1.519Zm-16.364,0A1.054,1.054,0,0,1,370,466h0a1.054,1.054,0,0,1,1.054-1.054h1.519A1.056,1.056,0,0,1,373.631,466h0a1.055,1.055,0,0,1-1.054,1.054h-1.519Zm14.518,6.014L384.5,471.99a1.054,1.054,0,0,1,0-1.489h0a1.056,1.056,0,0,1,1.49,0h0l1.075,1.073a1.059,1.059,0,0,1,0,1.492h0a1.057,1.057,0,0,1-.746.308h0a1.052,1.052,0,0,1-.746-0.308h0ZM374.005,461.5l-1.074-1.077a1.054,1.054,0,0,1,0-1.488h0a1.052,1.052,0,0,1,1.491,0h0l1.076,1.074a1.057,1.057,0,0,1,0,1.491h0a1.068,1.068,0,0,1-.746.307h0a1.065,1.065,0,0,1-.747-0.307h0Z" transform="translate(-370 -456)"/>
            </svg>
        </a>
    </li>
    <li <?php bl_active($order_page,'archive')?>>
        <a class="side-menu-icon" href="/orders?orders_page=archive">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16">
                <path d="M382.206,520.083H377.8a0.612,0.612,0,0,0-.6.62V522.1a0.612,0.612,0,0,0,.6.62h4.411a0.613,0.613,0,0,0,.6-0.62V520.7A0.613,0.613,0,0,0,382.206,520.083Zm-0.173,1.835h-4.066v-1.037h4.066v1.037Zm7.771-5.281,0.006,0-2.906-5.91a1.363,1.363,0,0,0-1.225-.775h-0.552V509.4a0.393,0.393,0,0,0-.388-0.4h-9.478a0.393,0.393,0,0,0-.388.4v0.549h-0.552a1.361,1.361,0,0,0-1.224.775l-2.907,5.91,0.006,0a1.422,1.422,0,0,0-.2.722V523.6a1.378,1.378,0,0,0,1.357,1.4h17.286A1.378,1.378,0,0,0,390,523.6v-6.245A1.422,1.422,0,0,0,389.8,516.637Zm-4.677-5.8h0.552a0.508,0.508,0,0,1,.456.289l2.38,4.84H386.9v-1.489a0.393,0.393,0,0,0-.388-0.4H386.03v-2.139a0.394,0.394,0,0,0-.388-0.4h-0.515v-0.7Zm0.994,4.038v1.091h-2.045a0.893,0.893,0,0,0-.815.542l-0.558,1.274a0.034,0.034,0,0,1-.03.02h-5.346a0.034,0.034,0,0,1-.03-0.02l-0.558-1.274a0.893,0.893,0,0,0-.815-0.542h-2.045v-1.091h12.242ZM375.649,509.8h8.7v1.74h-8.7V509.8Zm9.605,2.538v1.74H374.746v-1.74h10.508Zm-11.389-1.212a0.508,0.508,0,0,1,.456-0.289h0.552v0.7h-0.515a0.394,0.394,0,0,0-.388.4v2.139h-0.479a0.393,0.393,0,0,0-.388.4v1.49h-1.618Zm14.778,12.991H371.357a0.5,0.5,0,0,1-.5-0.51v-6.245a0.5,0.5,0,0,1,.5-0.51h4.567a0.034,0.034,0,0,1,.03.02l0.558,1.274a0.894,0.894,0,0,0,.815.541h5.346a0.894,0.894,0,0,0,.815-0.541l0.558-1.274h0a0.034,0.034,0,0,1,.03-0.02h4.567a0.5,0.5,0,0,1,.5.51V523.6h0A0.5,0.5,0,0,1,388.643,524.114Z" transform="translate(-370 -509)"/>
            </svg>
        </a>
    </li>
    <li <?php bl_active($order_page,'delete')?>>
        <a class="side-menu-icon" href="/orders?orders_page=delete">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20">
                <path d="M415.667,567H424a0.334,0.334,0,0,0,0-.667h-8.333A0.334,0.334,0,1,0,415.667,567Zm0-2.667H419a0.333,0.333,0,0,0,0-.666h-3.333A0.333,0.333,0,1,0,415.667,564.333Zm0,5.334H424a0.334,0.334,0,0,0,0-.667h-8.333A0.334,0.334,0,1,0,415.667,569.667Zm5.666,2h-5.666a0.333,0.333,0,1,0,0,.666h5.666A0.333,0.333,0,1,0,421.333,571.667Zm-1,2.666h-4.666a0.334,0.334,0,1,0,0,.667h4.666A0.334,0.334,0,1,0,420.333,574.333Zm7.334-3.879v-6.592L422.805,559H412v20h14.667A4.331,4.331,0,0,0,427.667,570.454ZM423,560.138l3.529,3.529H423v-3.529Zm1.359,18.195H412.667V559.667h9.666v4.666H427v6.015q-0.171-.015-0.333-0.015a4.339,4.339,0,0,0-4.334,4.334c0,0.133.009,0.264,0.02,0.394l0.009,0.091c0.015,0.127.033,0.253,0.058,0.377,0,0.014.007,0.029,0.01,0.043,0.024,0.113.053,0.224,0.086,0.333l0.024,0.082c0.038,0.117.08,0.233,0.127,0.346L422.7,576.4c0.043,0.1.09,0.2,0.14,0.289l0.035,0.069c0.059,0.105.121,0.208,0.188,0.309l0.047,0.067c0.061,0.088.125,0.174,0.192,0.257l0.038,0.048q0.115,0.138.243,0.267c0.02,0.021.041,0.041,0.063,0.062,0.081,0.079.165,0.157,0.253,0.23l0.023,0.02c0.094,0.077.192,0.149,0.293,0.219l0.073,0.05C424.309,578.3,424.334,578.317,424.359,578.333Zm2.308,0a3.667,3.667,0,1,1,0-7.333c0.1,0,.206.007,0.308,0.016s0.2,0.022.3,0.039l0.148,0.025A3.666,3.666,0,0,1,426.667,578.333Zm1.65-5.316a0.333,0.333,0,0,0-.472,0l-1.178,1.178-1.179-1.178a0.333,0.333,0,0,0-.471.471l1.178,1.179-1.178,1.178a0.333,0.333,0,0,0,.471.472l1.179-1.179,1.178,1.179a0.334,0.334,0,0,0,.472-0.472l-1.179-1.178,1.179-1.179A0.333,0.333,0,0,0,428.317,573.017Z" transform="translate(-412 -559)"/>
            </svg>
        </a>
    </li>
    <li <?php bl_active($order_page,'reminder')?>>
        <a class="side-menu-icon" href="/orders?orders_page=reminder">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="24" viewBox="0 0 21 24">
                <path d="M389.874,632.763a9.771,9.771,0,0,1-3.051-7.108V621.73a6.35,6.35,0,0,0-3.707-5.767,8.713,8.713,0,0,0-1.518-.531v-0.25a2.173,2.173,0,1,0-4.345,0v0.288a8.543,8.543,0,0,0-1.367.5,6.6,6.6,0,0,0-3.848,5.76v3.928a9.7,9.7,0,0,1-2.914,7.108,0.437,0.437,0,0,0,.233.74l4.124,0.715c0.768,0.133,1.476.242,2.149,0.332a4.288,4.288,0,0,0,7.749,0c0.67-.089,1.374-0.2,2.138-0.33l4.124-.716A0.437,0.437,0,0,0,389.874,632.763Zm-11.753-17.581a1.3,1.3,0,1,1,2.607,0v0.079a8.6,8.6,0,0,0-2.607.021v-0.1Zm1.383,20.945a3.479,3.479,0,0,1-2.788-1.446,26.9,26.9,0,0,0,2.783.151,26.562,26.562,0,0,0,2.794-.153A3.476,3.476,0,0,1,379.5,636.127Zm5.865-2.769c-0.833.144-1.6,0.262-2.32,0.354h0c-0.318.041-.627,0.076-0.93,0.107h-0.009c-0.277.028-.548,0.051-0.816,0.07l-0.152.011c-0.232.015-.461,0.027-0.689,0.036l-0.141.006c-0.541.018-1.074,0.018-1.614,0l-0.144-.006q-0.337-.014-0.681-0.036l-0.162-.011c-0.261-.019-0.524-0.041-0.794-0.067l-0.028,0c-0.3-.03-0.608-0.065-0.924-0.106h0c-0.725-.092-1.492-0.21-2.329-0.355l-3.329-.578a10.53,10.53,0,0,0,2.607-7.125V621.73a5.713,5.713,0,0,1,3.342-4.971,7.753,7.753,0,0,1,1.519-.516h0.014a7.86,7.86,0,0,1,3.293-.03h0.017a7.781,7.781,0,0,1,1.663.545,5.541,5.541,0,0,1,3.2,4.971v3.927a10.641,10.641,0,0,0,2.743,7.126Zm-3.156-15.41a6.615,6.615,0,0,0-5.418,0,4.412,4.412,0,0,0-2.585,3.777,0.436,0.436,0,0,0,.432.439h0a0.436,0.436,0,0,0,.435-0.434,3.514,3.514,0,0,1,2.079-2.989,5.728,5.728,0,0,1,4.692,0A0.436,0.436,0,0,0,382.213,617.948Z" transform="translate(-369 -613)"/>
            </svg>
        </a>
    </li>
    <li <?php bl_active($order_page,'mark')?>>
        <a class="side-menu-icon" href="/orders?orders_page=mark">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21">
                <path d="M394.86,678.4h8.772a0.35,0.35,0,1,0,0-.7H394.86A0.35,0.35,0,1,0,394.86,678.4Zm0-2.8h3.508a0.35,0.35,0,1,0,0-.7H394.86A0.35,0.35,0,1,0,394.86,675.6Zm0,5.6h8.772a0.35,0.35,0,0,0,0-.7H394.86A0.35,0.35,0,1,0,394.86,681.2Zm5.965,2.1H394.86a0.35,0.35,0,1,0,0,.7h5.965A0.35,0.35,0,0,0,400.825,683.3Zm-1.053,2.8H394.86a0.35,0.35,0,1,0,0,.7h4.912A0.35,0.35,0,1,0,399.772,686.1Zm7.719-4.073v-6.922L402.373,670H391v21h15.439A4.546,4.546,0,0,0,407.491,682.027ZM402.579,671.2l3.714,3.7h-3.714v-3.7Zm1.431,19.1H391.7V670.7h10.175v4.9h4.912v6.315c-0.12-.01-0.236-0.015-0.35-0.015a4.561,4.561,0,0,0-4.562,4.55c0,0.14.009,0.277,0.021,0.414,0,0.032.006,0.063,0.01,0.095,0.015,0.134.034,0.266,0.06,0.4,0,0.015.008,0.031,0.011,0.046,0.025,0.118.056,0.234,0.09,0.349,0.009,0.029.017,0.058,0.026,0.086,0.04,0.124.084,0.245,0.133,0.363l0.03,0.066c0.045,0.1.094,0.205,0.147,0.305,0.013,0.023.024,0.048,0.037,0.071,0.062,0.111.128,0.219,0.2,0.325,0.016,0.024.033,0.047,0.05,0.071,0.064,0.092.131,0.182,0.2,0.269,0.013,0.017.026,0.034,0.04,0.05,0.081,0.1.166,0.191,0.255,0.281l0.066,0.065c0.086,0.083.174,0.165,0.267,0.241a0.241,0.241,0,0,0,.024.021c0.1,0.082.2,0.157,0.308,0.231l0.078,0.052Zm2.429,0a3.85,3.85,0,1,1,0-7.7c0.109,0,.217.007,0.325,0.016s0.207,0.024.318,0.042l0.156,0.026A3.849,3.849,0,0,1,406.439,690.3Zm1.817-5.8-1.964,2.814-1.385-1.135a0.351,0.351,0,1,0-.445.542l1.679,1.375a0.355,0.355,0,0,0,.223.079l0.048,0a0.355,0.355,0,0,0,.24-0.147l2.18-3.125A0.351,0.351,0,0,0,408.256,684.5Z" transform="translate(-391 -670)"/>
            </svg>
        </a>
    </li>
    <li <?php bl_active($order_page,'filter')?>>
        <a class="side-menu-icon" href="/orders?orders_page=filter">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21">
                <path d="M389.584,724H370.416a0.417,0.417,0,0,0-.416.418v2.437a0.414,0.414,0,0,0,.121.294h0l7.971,8.08v6.95a0.42,0.42,0,0,0,.156.327l2.983,2.4a0.41,0.41,0,0,0,.259.092,0.416,0.416,0,0,0,.416-0.418v-9.351l7.971-8.08h0a0.414,0.414,0,0,0,.121-0.294v-2.437A0.417,0.417,0,0,0,389.584,724Zm-8.508,19.711-2.151-1.731v-6.5h2.151v8.234Zm0.242-9.07h-2.636l-7.268-7.368h17.172Zm7.85-8.2H370.832v-1.6h18.336v1.6Zm-11.439,5.406-0.179-.18a0.415,0.415,0,0,0-.588,0,0.419,0.419,0,0,0,0,.592l0.179,0.18a0.413,0.413,0,0,0,.588,0A0.421,0.421,0,0,0,377.729,731.842Zm-1.094-1.1-2.863-2.881a0.415,0.415,0,0,0-.588,0,0.421,0.421,0,0,0,0,.592l2.863,2.881a0.415,0.415,0,0,0,.588,0A0.419,0.419,0,0,0,376.635,730.742Z" transform="translate(-370 -724)"/>
            </svg>
        </a>
    </li>
    <li <?php bl_active($order_page,'search')?>>
        <a class="side-menu-icon" href="/orders?orders_page=search">
            <svg xmlns="http://www.w3.org/2000/svg" width="17.031" height="18" viewBox="0 0 17.031 18">
                <path d="M388.755,794.4l-4.194-4.455a7.344,7.344,0,0,0,1.669-4.673,7.117,7.117,0,1,0-7.116,7.268,6.936,6.936,0,0,0,4.077-1.316l4.227,4.49a0.915,0.915,0,0,0,1.311.026A0.963,0.963,0,0,0,388.755,794.4Zm-9.641-14.5a5.373,5.373,0,1,1-5.259,5.371A5.322,5.322,0,0,1,379.114,779.9Z" transform="translate(-372 -778)"/>
            </svg>
        </a>
    </li>
    <li <?php bl_active($order_page,'my-orders')?>>
        <a class="side-menu-icon" href="my-orders.html">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" viewBox="0 0 18 22">
                <path d="M386.457,831.636h-3.465a3.016,3.016,0,0,0-5.984,0h-3.465A2.531,2.531,0,0,0,371,834.149v0.129a2.516,2.516,0,0,0,1.607,2.335v11.874A2.532,2.532,0,0,0,375.15,851h9.7a2.532,2.532,0,0,0,2.543-2.513V836.613A2.516,2.516,0,0,0,389,834.278v-0.129A2.531,2.531,0,0,0,386.457,831.636ZM380,830.192a1.806,1.806,0,0,1,1.774,1.444h-3.547A1.8,1.8,0,0,1,380,830.192Zm6.187,18.295a1.331,1.331,0,0,1-1.337,1.321h-9.7a1.331,1.331,0,0,1-1.337-1.321V836.792h12.374v11.695Zm1.607-14.209a1.331,1.331,0,0,1-1.337,1.322H373.543a1.331,1.331,0,0,1-1.337-1.322v-0.129a1.331,1.331,0,0,1,1.337-1.321h12.914a1.331,1.331,0,0,1,1.337,1.321v0.129Zm-11.027,14.006a0.6,0.6,0,0,0,.6-0.6v-6.711a0.6,0.6,0,0,0-1.206,0v6.711A0.6,0.6,0,0,0,376.767,848.284Zm3.233,0a0.6,0.6,0,0,0,.6-0.6v-6.711a0.6,0.6,0,0,0-1.206,0v6.711A0.6,0.6,0,0,0,380,848.284Zm3.233,0a0.6,0.6,0,0,0,.6-0.6v-6.711a0.6,0.6,0,0,0-1.206,0v6.711A0.6,0.6,0,0,0,383.233,848.284Z" transform="translate(-371 -829)"/>
            </svg>
        </a>
    </li>
    <li <?php bl_active($order_page,'sdf')?>>
        <a class="side-menu-icon" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <path d="M389.643,884H370.357a0.357,0.357,0,0,0-.357.357v19.286a0.357,0.357,0,0,0,.357.357h19.286a0.357,0.357,0,0,0,.357-0.357V884.357A0.357,0.357,0,0,0,389.643,884Zm-0.357,19.286H370.714V884.714h18.572v18.572h0Zm-13.572-17.143a3.572,3.572,0,1,0,3.572,3.571A3.575,3.575,0,0,0,375.714,886.143Zm0,6.428a2.857,2.857,0,1,1,2.857-2.857A2.86,2.86,0,0,1,375.714,892.571Zm8.572-6.428a3.572,3.572,0,1,0,3.571,3.571A3.575,3.575,0,0,0,384.286,886.143Zm0,6.428a2.857,2.857,0,1,1,2.857-2.857A2.859,2.859,0,0,1,384.286,892.571Zm-8.572,2.143a3.572,3.572,0,1,0,3.572,3.572A3.575,3.575,0,0,0,375.714,894.714Zm0,6.429a2.857,2.857,0,1,1,2.857-2.857A2.861,2.861,0,0,1,375.714,901.143Zm8.572-6.429a3.572,3.572,0,1,0,3.571,3.572A3.576,3.576,0,0,0,384.286,894.714Zm0,6.429a2.857,2.857,0,1,1,2.857-2.857A2.86,2.86,0,0,1,384.286,901.143Zm-8.572-13.572a0.357,0.357,0,0,0-.357.358V891.5a0.357,0.357,0,0,0,.714,0v-3.571A0.357,0.357,0,0,0,375.714,887.571Zm10.087,9.2a0.358,0.358,0,0,0-.5,0l-2.525,2.526a0.357,0.357,0,1,0,.5.5l2.526-2.526A0.356,0.356,0,0,0,385.8,896.77Zm-8.3-7.413h-3.571a0.357,0.357,0,1,0,0,.714H377.5A0.357,0.357,0,1,0,377.5,889.357Zm-0.271,9.939L374.7,896.77a0.357,0.357,0,0,0-.5.5l2.526,2.526A0.357,0.357,0,1,0,377.229,899.3Zm0-2.526a0.357,0.357,0,0,0-.5,0L374.2,899.3a0.357,0.357,0,1,0,.5.5l2.525-2.526A0.356,0.356,0,0,0,377.229,896.77Zm8.842-7.413H382.5a0.357,0.357,0,1,0,0,.714h3.571A0.357,0.357,0,1,0,386.071,889.357Z" transform="translate(-370 -884)"/>
            </svg>
        </a>
    </li>
    <li <?php bl_active($order_page,'executor')?>>
        <a class="side-menu-icon" href="/orders?orders_page=executor">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22">
                <path d="M390.866,958.217a0.387,0.387,0,0,0-.055-0.045l-2.937-2.949a5.517,5.517,0,0,0-.305-7.446,5.451,5.451,0,0,0-3.873-1.611,5.757,5.757,0,0,0-.587.032,5.847,5.847,0,0,0,.518-2.341,6.6,6.6,0,0,0-.749-4.471l-0.006-.086-0.042,0a5.97,5.97,0,0,0-1.074-1.288A5.131,5.131,0,0,0,378.565,937a5.629,5.629,0,0,0-3.229,1.017c-2.12,1.458-1.906,5.134-1.906,5.134a3.874,3.874,0,0,0,.415.073c-0.019.206-.03,0.417-0.03,0.633a6.491,6.491,0,0,0,1.368,3.8l-0.01,1.307-0.009.022c-0.1.194-.487,0.605-1.978,1.175a10.1,10.1,0,0,1-1.684.66l-0.065.019A2.093,2.093,0,0,0,370,952.823v2.51h9.613c0.067,0.076.137,0.15,0.209,0.223a5.461,5.461,0,0,0,7.406.314l2.988,3,0,0A0.458,0.458,0,1,0,390.866,958.217Zm-8.441-17.7a5.264,5.264,0,0,1,.29.975l-0.052-.06a2.516,2.516,0,0,0-.542-0.465A1.729,1.729,0,0,1,382.425,940.519Zm-7.941.785a3.959,3.959,0,0,1,1.367-2.53,4.7,4.7,0,0,1,2.714-.858,4.938,4.938,0,0,1,1.655.287,2.935,2.935,0,0,1,.923.494,5.1,5.1,0,0,1,.845.986,0.858,0.858,0,0,1-1.1.941,3.934,3.934,0,0,0-1.946.609,8.307,8.307,0,0,1-4.128,1.135c-0.17,0-.326-0.006-0.464-0.014A8.538,8.538,0,0,1,374.484,941.3Zm0.244,2.553a5.63,5.63,0,0,1,.029-0.572h0.06a9.194,9.194,0,0,0,4.58-1.257,3.087,3.087,0,0,1,1.494-.488,1.877,1.877,0,0,1,1.652,1.554,1.824,1.824,0,0,0,.155.333c0.01,0.141.016,0.283,0.016,0.429a5.265,5.265,0,0,1-.755,2.592,5.5,5.5,0,0,0-3.1,2.627,1.2,1.2,0,0,1-.141.01,4.035,4.035,0,0,1-2.467-1.561A5.773,5.773,0,0,1,374.728,943.857Zm3.723,6.219a5.5,5.5,0,0,0-.191.9h-0.122l-0.111-.559Zm-1.469,4.34h-6.069v-1.593a1.178,1.178,0,0,1,.8-1.113l0.038-.011a7.535,7.535,0,0,0,1.445-.543c0.124-.06.221-0.107,0.318-0.143a7.4,7.4,0,0,0,1.927-1l1.285,1.46,0.5-.408,0.093,0.468Zm-0.154-4.2-0.806-.916,0.063-.139v-0.194l0-.3a5.964,5.964,0,0,0,1.408,1Zm1.893,4.2H377.9l0.3-2.521h0.026a5.5,5.5,0,0,0,.728,2.521h-0.229Zm8.2,0.491a4.593,4.593,0,1,1,1.338-3.241A4.523,4.523,0,0,1,386.923,954.907ZM383.7,948a3.66,3.66,0,0,0-3.653,3.666,0.457,0.457,0,1,0,.913,0,2.748,2.748,0,0,1,2.74-2.75A0.458,0.458,0,0,0,383.7,948Z" transform="translate(-370 -937)"/>
            </svg>
        </a>
    </li>
    <li <?php bl_active($order_page,'control')?>>
        <a class="side-menu-icon" href="/orders?orders_page=control">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 20 22">
                <path d="M380.579,1004.93a1.262,1.262,0,0,0,.924-0.54l3.32-4.742a0.375,0.375,0,0,0-.037-0.474,0.346,0.346,0,0,0-.458-0.038l-4.591,3.434a1.316,1.316,0,0,0-.516.95,1.329,1.329,0,0,0,.366,1.03,1.223,1.223,0,0,0,.892.38h0.1Zm-0.651-1.35a0.575,0.575,0,0,1,.226-0.42l2.8-2.09-2.025,2.89a0.567,0.567,0,0,1-.406.24,0.553,0.553,0,0,1-.435-0.17A0.583,0.583,0,0,1,379.928,1003.58Zm8.594-5.406c0-.008,0-0.016-0.008-0.024s-0.011-.011-0.015-0.018a10.039,10.039,0,0,0-1.264-1.764l0.761-.787,0.5,0.519,1.5-1.556-1.5-1.556-1.5,1.556,0.5,0.519-0.762.787a9.662,9.662,0,0,0-1.7-1.308c-0.007,0-.011-0.011-0.018-0.016s-0.015,0-.022-0.008a9.31,9.31,0,0,0-3.643-1.248v-0.437h0.532a0.917,0.917,0,0,0,0-1.833h-3.191a0.917,0.917,0,0,0,0,1.833h0.532v0.424a9.529,9.529,0,0,0-1.144.2,0.368,0.368,0,0,0-.266.44,0.354,0.354,0,0,0,.425.275,8.777,8.777,0,0,1,.986-0.175l0.38-.03c0.117-.009.224-0.016,0.328-0.021v0.725a0.355,0.355,0,1,0,.709,0v-0.723a8.573,8.573,0,0,1,3.708,1.044l-0.35.625a0.374,0.374,0,0,0,.13.5,0.339,0.339,0,0,0,.177.049,0.349,0.349,0,0,0,.307-0.183l0.349-.624a9.08,9.08,0,0,1,2.756,2.849l-0.6.361a0.374,0.374,0,0,0-.129.5,0.354,0.354,0,0,0,.307.183,0.343,0.343,0,0,0,.177-0.049l0.606-.362a9.345,9.345,0,0,1,1.01,3.891h-0.7a0.37,0.37,0,0,0,0,.74h0.7a9.336,9.336,0,0,1-1.01,3.89l-0.606-.36a0.352,0.352,0,0,0-.484.13,0.371,0.371,0,0,0,.13.5l0.6,0.36a8.99,8.99,0,0,1-2.756,2.85l-0.349-.62a0.347,0.347,0,0,0-.484-0.14,0.385,0.385,0,0,0-.13.51l0.35,0.62a8.522,8.522,0,0,1-3.708,1.04v-0.72a0.355,0.355,0,1,0-.709,0v0.73a8.871,8.871,0,0,1-1.694-.23,0.352,0.352,0,0,0-.425.28,0.374,0.374,0,0,0,.267.44,9.76,9.76,0,0,0,2.148.25h0.066a9.272,9.272,0,0,0,4.687-1.31c0.011-.01.023-0.01,0.034-0.02s0.011-.01.017-0.01a9.868,9.868,0,0,0,3.466-3.58c0.007-.01.015-0.02,0.021-0.03a0.038,0.038,0,0,1,.008-0.02A10.161,10.161,0,0,0,388.522,998.174Zm-0.025-4.149,0.5,0.519-0.5.519-0.5-.519Zm-8.571-.817V992.1h-1.241a0.184,0.184,0,0,1,0-.367h3.191a0.184,0.184,0,0,1,0,.367h-1.241v1.108c-0.123,0-.241-0.008-0.354-0.008h-0.058c-0.058,0-.117,0-0.175,0Zm-2.837,2.925h-1.773a0.367,0.367,0,0,0,0,.734h1.773A0.367,0.367,0,0,0,377.089,996.133Zm0,2.567h-3.546a0.367,0.367,0,0,0,0,.733h3.546A0.367,0.367,0,0,0,377.089,998.7Zm0,2.57H371.77a0.365,0.365,0,0,0,0,.73h5.319A0.365,0.365,0,0,0,377.089,1001.27Zm0,2.56h-6.737a0.37,0.37,0,0,0,0,.74h6.737A0.37,0.37,0,0,0,377.089,1003.83Zm0,2.57h-4.61a0.365,0.365,0,0,0,0,.73h4.61A0.365,0.365,0,0,0,377.089,1006.4Zm0,2.57h-2.482a0.365,0.365,0,0,0,0,.73h2.482A0.365,0.365,0,0,0,377.089,1008.97Z" transform="translate(-370 -991)"/>
            </svg>
        </a>
    </li>
</ul>
<ul class="side-menu-links">
    <li <?php bl_active($order_page,'new')?>><a class="side-menu-link" href="/orders?orders_page=new">Новый заказ</a></li>
    <li <?php bl_active($order_page,'draft')?>><a class="side-menu-link" href="/orders?orders_page=draft">Черновик</a></li>
    <li <?php bl_active($order_page,'inwork')?>><a class="side-menu-link" href="/orders?orders_page=inwork">В работе</a></li>
    <li <?php bl_active($order_page,'archive')?>><a class="side-menu-link" href="/orders?orders_page=archive">Архив</a></li>
    <li <?php bl_active($order_page,'delete')?>><a class="side-menu-link" href="/orders?orders_page=delete">Удалить заказ</a></li>
    <li <?php bl_active($order_page,'reminder')?>><a class="side-menu-link" href="/orders?orders_page=reminder">Установить напоминание</a></li>
    <li <?php bl_active($order_page,'mark')?>><a class="side-menu-link" href="/orders?orders_page=mark">Пометить заказ</a></li>
    <li <?php bl_active($order_page,'filter')?>><a class="side-menu-link" href="/orders?orders_page=filter">Фильтр</a></li>
    <li <?php bl_active($order_page,'search')?>><a class="side-menu-link" href="/orders?orders_page=search">Поиск</a></li>
    <li <?php bl_active($order_page,'my-orders')?>><a class="side-menu-link" href="my-orders">Очистить</a></li>
    <li <?php bl_active($order_page,'calc')?>><a class="side-menu-link" href="#">Калькулятор</a></li>
    <li <?php bl_active($order_page,'se')?>><a class="side-menu-link" href="#">Поиск исполнителя</a></li>
    <li <?php bl_active($order_page,'control')?>><a class="side-menu-link" href="/orders?orders_page=control">Контроль сроков</a></li>
</ul>
<button type="button" class="side-menu-extend"></button>