<?php
header('Content-Type: text/css; charset=utf-8');
?>
<style>
    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: local("IBM Plex Sans Bold"), local("IBMPlexSans-Bold"),
            url(" ./ibm-plex-sans/complete/woff/IBMPlexSans-Bold.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: local("IBM Plex Sans Bold"), local("IBMPlexSans-Bold"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-Bold-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 700;
        font-display: swap;
        src: local("IBM Plex Sans Bold Italic"), local("IBMPlexSans-BoldItalic"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-BoldItalic.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 700;
        font-display: swap;
        src: local("IBM Plex Sans Bold Italic"),
            local("IBMPlexSans-BoldItalic"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-BoldItalic-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 200;
        font-display: swap;
        src: local("IBM Plex Sans ExtraLight"),
            local("IBMPlexSans-ExtraLight"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-ExtraLight.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 200;
        font-display: swap;
        src: local("IBM Plex Sans ExtraLight"),
            local("IBMPlexSans-ExtraLight"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-ExtraLight-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 200;
        font-display: swap;
        src: local("IBM Plex Sans ExtraLight Italic"),
            local("IBMPlexSans-ExtraLightItalic"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-ExtraLightItalic.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 200;
        font-display: swap;
        src: local("IBM Plex Sans ExtraLight Italic"),
            local("IBMPlexSans-ExtraLightItalic"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-ExtraLightItalic-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 400;
        font-display: swap;
        src: local("IBM Plex Sans Italic"),
            local("IBMPlexSans-Italic"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-Italic.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 400;
        font-display: swap;
        src: local("IBM Plex Sans Italic"),
            local("IBMPlexSans-Italic"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-Italic-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 300;
        font-display: swap;
        src: local("IBM Plex Sans Light"),
            local("IBMPlexSans-Light"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-Light.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 300;
        font-display: swap;
        src: local("IBM Plex Sans Light"),
            local("IBMPlexSans-Light"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-Light-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 300;
        font-display: swap;
        src: local("IBM Plex Sans Light Italic"),
            local("IBMPlexSans-LightItalic"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-LightItalic.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 300;
        font-display: swap;
        src: local("IBM Plex Sans Light Italic"),
            local("IBMPlexSans-LightItalic"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-LightItalic-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: local("IBM Plex Sans Medium"),
            local("IBMPlexSans-Medium"),
            url("fonts/ibm-plex-sans/complete/woff/IBMPlexSans-Medium.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: local("IBM Plex Sans Medium"),
            local("IBMPlexSans-Medium"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-Medium-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 500;
        font-display: swap;
        src: local("IBM Plex Sans Medium Italic"),
            local("IBMPlexSans-MediumItalic"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-MediumItalic.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 500;
        font-display: swap;
        src: local("IBM Plex Sans Medium Italic"),
            local("IBMPlexSans-MediumItalic"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-MediumItalic-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: local("IBM Plex Sans"),
            local("IBMPlexSans"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-Regular.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: local("IBM Plex Sans"),
            local("IBMPlexSans"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-Regular-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 600;
        font-display: swap;
        src: local("IBM Plex Sans SemiBold"),
            local("IBMPlexSans-SemiBold"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-SemiBold.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 600;
        font-display: swap;
        src: local("IBM Plex Sans SemiBold"),
            local("IBMPlexSans-SemiBold"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-SemiBold-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 600;
        font-display: swap;
        src: local("IBM Plex Sans SemiBold Italic"),
            local("IBMPlexSans-SemiBoldItalic"),
            url(ibmCompleteSemiBoldItalicWoff) format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 600;
        font-display: swap;
        src: local("IBM Plex Sans SemiBold Italic"),
            local("IBMPlexSans-SemiBoldItalic"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-SemiBoldItalic-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 450;
        font-display: swap;
        src: local("IBM Plex Sans Text"),
            local("IBMPlexSans-Text"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-Text.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 450;
        font-display: swap;
        src: local("IBM Plex Sans Text"),
            local("IBMPlexSans-Text"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-Text-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 450;
        font-display: swap;
        src: local("IBM Plex Sans Text Italic"),
            local("IBMPlexSans-TextItalic"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-TextItalic.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 450;
        font-display: swap;
        src: local("IBM Plex Sans Text Italic"),
            local("IBMPlexSans-TextItalic"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-TextItalic-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 100;
        font-display: swap;
        src: local("IBM Plex Sans Thin"),
            local("IBMPlexSans-Thin"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-Thin.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: normal;
        font-weight: 100;
        font-display: swap;
        src: local("IBM Plex Sans Thin"),
            local("IBMPlexSans-Thin"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-Thin-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 100;
        font-display: swap;
        src: local("IBM Plex Sans Thin Italic"),
            local("IBMPlexSans-ThinItalic"),
            url("./ibm-plex-sans/complete/woff/IBMPlexSans-ThinItalic.woff") format("woff");
    }

    @font-face {
        font-family: "IBM Plex Sans";
        font-style: italic;
        font-weight: 100;
        font-display: swap;
        src: local("IBM Plex Sans Thin Italic"),
            local("IBMPlexSans-ThinItalic"),
            url("./ibm-plex-sans/split/woff2/IBMPlexSans-ThinItalic-Latin1.woff2") format("woff2");
        unicode-range: U+0000, U+000D, U+0020-007E, U+00A0-00A3, U+00A4-00FF,
            U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2013-2014,
            U+2018-201A, U+201C-201E, U+2020-2022, U+2026, U+2030, U+2039-203A,
            U+2044, U+2074, U+20AC, U+2122, U+2212, U+FB01-FB02;
    }
</style>
