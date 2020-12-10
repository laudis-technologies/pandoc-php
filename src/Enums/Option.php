<?php

declare(strict_types=1);

/*
 * This file is part of the Laudis Pandoc package.
 *
 * (c) Laudis technologies <https://laudis.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Laudis\Pandoc\Enums;

use Laudis\TypedEnum\TypedEnum;

/**
 * @method static Option FROM_FORMAT()
 * @method static Option READ_FORMAT()
 * @method static Option WRITE_FORMAT()
 * @method static Option TO_FORMAT()
 * @method static Option OUTPUT_FILE()
 * @method static Option DATA_DIR()
 * @method static Option METADATA_KEY()
 * @method static Option METADATA_FILE()
 * @method static Option FILE_SCOPE()
 * @method static Option STANDALONE()
 * @method static Option TEMPLATE()
 * @method static Option VARIABLE()
 * @method static Option WRAP()
 * @method static Option ASCII()
 * @method static Option TOC()
 * @method static Option TOC_DEPTH()
 * @method static Option NUMBER_SECTIONS()
 * @method static Option NUMBER_OFFSET()
 * @method static Option TOP_LEVEL_DIVISION()
 * @method static Option EXTRACT_MEDIA()
 * @method static Option RESOURCE_PATH()
 * @method static Option INCLUDE_IN_HEADER()
 * @method static Option INCLUDE_BEFORE_BODY()
 * @method static Option INCLUDE_AFTER_BODY()
 * @method static Option NO_HIGHLIGHT()
 * @method static Option HIGHLIGHT_STYLE()
 * @method static Option SYNTAX_DEFINITION()
 * @method static Option DPI()
 * @method static Option EOL()
 * @method static Option COLUMNS()
 * @method static Option PRESER_TABS()
 * @method static Option TAB_STOP()
 * @method static Option PDF_ENGINE()
 * @method static Option PDF_ENGINE_OPT()
 * @method static Option REFERENCE_DOC()
 * @method static Option SELF_CONTAINED()
 * @method static Option REQUEST_HEADER()
 * @method static Option NO_CHECK_CERTIFICATE()
 * @method static Option ABBREVIATIONS()
 * @method static Option INDENTED_CODE_CLASSES()
 * @method static Option DEFAULT_IMAGE_EXTENSION()
 * @method static Option FILTER_PROGRAM()
 * @method static Option LUA_FILTER()
 * @method static Option SHIFT_HEADING_LEVEL_BY()
 * @method static Option BASE_HEADER_LEVEL()
 * @method static Option STRIP_EMPTY_PARAGRAPHS()
 * @method static Option TRACK_CHANGES()
 * @method static Option STRIP_COMMENTS()
 * @method static Option REFERENCE_LINKS()
 * @method static Option REFERENCE_LOCATION()
 * @method static Option ATX_HEADERS()
 * @method static Option LISTINGS()
 * @method static Option INCREMENTAL()
 * @method static Option SLIDE_LEVEL()
 * @method static Option SECTION_DIVS()
 * @method static Option HTML_Q_TAGS()
 * @method static Option EMAIL_OBFUSCATION()
 * @method static Option ID_PREFIX()
 * @method static Option TITLE_PREFIX()
 * @method static Option CSS()
 * @method static Option EPUB_SUBDIRECTORY()
 * @method static Option EPUB_COVER_IMAGE()
 * @method static Option EPUB_METADATA()
 * @method static Option EPUB_EMBED_FONT()
 * @method static Option EPUB_CHAPTER_LEVEL()
 * @method static Option IPYNB_OUTPUT()
 * @method static Option CITEPROC()
 * @method static Option BIBLIOGRAPHY()
 * @method static Option CSL()
 * @method static Option CITATION_ABBREVIATIONS()
 * @method static Option NATBIB()
 * @method static Option BIBLATEX()
 * @method static Option MATHML()
 * @method static Option WEBTEX()
 * @method static Option MATHJAX()
 * @method static Option KATEX()
 * @method static Option GLADTEX()
 * @method static Option TRACE()
 * @method static Option DUMP_ARGS()
 * @method static Option IGNORE_ARGS()
 * @method static Option VERBOSE()
 * @method static Option QUIET()
 * @method static Option FAIL_IF_WARNINGS()
 * @method static Option LOG_FILE()
 * @method static Option BASH_COMPLETION()
 * @method static Option LIST_INPUT_FORMATS()
 * @method static Option LIST_OUTPUT_FORMATS()
 * @method static Option LIST_EXTENSIONS()
 * @method static Option LIST_HIGHLIGHT_LANGUAGES()
 * @method static Option LIST_HIGHLIGHT_STYLES()
 * @method static Option PRINT_DEFAULT_TEMPLATE()
 * @method static Option PRINT_DEFAULT_DATA_FILE()
 * @method static Option PRINT_HIGHLIGHT_STYLE()
 * @method static Option VERSION()
 * @method static Option HELP()
 *
 * @extends TypedEnum<string>
 */
final class Option extends TypedEnum
{
    private const FROM_FORMAT = '-f';
    private const READ_FORMAT = '-r';
    private const WRITE_FORMAT = '-1';
    private const TO_FORMAT = '-w';
    private const OUTPUT_FILE = '-o';
    private const DATA_DIR = '--data-dir';
    private const METADATA_KEY = '--meta';
    private const METADATA_FILE = '--metadata-file';
    private const FILE_SCOPE = '--file-scope';
    private const STANDALONE = '--standalone';
    private const TEMPLATE = '--template';
    private const VARIABLE = '-V';
    private const WRAP = '--wrap';
    private const ASCII = '--ascii';
    private const TOC = '--toc';
    private const TOC_DEPTH = '--toc-depth';
    private const NUMBER_SECTIONS = '-N';
    private const NUMBER_OFFSET = '--number-offset';
    private const TOP_LEVEL_DIVISION = '--top-level-division';
    private const EXTRACT_MEDIA = '--extract-media';
    private const RESOURCE_PATH = '--resource-path';
    private const INCLUDE_IN_HEADER = '-H';
    private const INCLUDE_BEFORE_BODY = '-B';
    private const INCLUDE_AFTER_BODY = '-A';
    private const NO_HIGHLIGHT = '--no-highlight';
    private const HIGHLIGHT_STYLE = '--highlight-style';
    private const SYNTAX_DEFINITION = '--syntax-definition';
    private const DPI = '--dpi';
    private const EOL = '--eol';
    private const COLUMNS = '--columns';
    private const PRESER_TABS = '-p';
    private const TAB_STOP = '--tab-stop';
    private const PDF_ENGINE = '--pdf-engine';
    private const PDF_ENGINE_OPT = '--pdf-engine-opt';
    private const REFERENCE_DOC = '--reference-doc';
    private const SELF_CONTAINED = '--self-contained';
    private const REQUEST_HEADER = '--request-header';
    private const NO_CHECK_CERTIFICATE = '--no-check-certificate';
    private const ABBREVIATIONS = '--abbreviations';
    private const INDENTED_CODE_CLASSES = '--indented-code-classes';
    private const DEFAULT_IMAGE_EXTENSION = '--default-image-extension';
    private const FILTER_PROGRAM = '-F';
    private const LUA_FILTER = '-L';
    private const SHIFT_HEADING_LEVEL_BY = '--shift-heading-level-by';
    private const BASE_HEADER_LEVEL = '--base-header-level';
    private const STRIP_EMPTY_PARAGRAPHS = '--strip-empty-paragraphs';
    private const TRACK_CHANGES = '--track-changes';
    private const STRIP_COMMENTS = '--strip-comments';
    private const REFERENCE_LINKS = '--reference-links';
    private const REFERENCE_LOCATION = '--reference-location';
    private const ATX_HEADERS = '--atx-headers';
    private const LISTINGS = '--listings';
    private const INCREMENTAL = '-i';
    private const SLIDE_LEVEL = '--slide-level';
    private const SECTION_DIVS = '--section-divs';
    private const HTML_Q_TAGS = '--html-q-tags';
    private const EMAIL_OBFUSCATION = '--email-obfuscation';
    private const ID_PREFIX = '--id-prefix';
    private const TITLE_PREFIX = '-T';
    private const CSS = '-c';
    private const EPUB_SUBDIRECTORY = '--epub-subdirectory';
    private const EPUB_COVER_IMAGE = '--epub-cover-image';
    private const EPUB_METADATA = '--epub-metadata';
    private const EPUB_EMBED_FONT = '--epub-embed-font';
    private const EPUB_CHAPTER_LEVEL = '--epub-chapter-level';
    private const IPYNB_OUTPUT = '--ipynb-output';
    private const CITEPROC = '-C';
    private const BIBLIOGRAPHY = '--bibliography';
    private const CSL = '--csl';
    private const CITATION_ABBREVIATIONS = '--citation-abbreviations';
    private const NATBIB = '--natbib';
    private const BIBLATEX = '--biblatex';
    private const MATHML = '--mathml';
    private const WEBTEX = '--webtex';
    private const MATHJAX = '--mathjax';
    private const KATEX = '--katex';
    private const GLADTEX = '--gladtex';
    private const TRACE = '--trace';
    private const DUMP_ARGS = '--dump-args';
    private const IGNORE_ARGS = '--ignore-args';
    private const VERBOSE = '--verbose';
    private const QUIET = '--quiet';
    private const FAIL_IF_WARNINGS = '--fail-if-warnings';
    private const LOG_FILE = '--log';
    private const BASH_COMPLETION = '--bash-completion';
    private const LIST_INPUT_FORMATS = '--list-input-formats';
    private const LIST_OUTPUT_FORMATS = '--list-output-formats';
    private const LIST_EXTENSIONS = '--list-extensions';
    private const LIST_HIGHLIGHT_LANGUAGES = '--list-highlight-languages';
    private const LIST_HIGHLIGHT_STYLES = '--list-highlight-styles';
    private const PRINT_DEFAULT_TEMPLATE = '-D';
    private const PRINT_DEFAULT_DATA_FILE = '--print-default-data-file';
    private const PRINT_HIGHLIGHT_STYLE = '--print-highlight-style';
    private const VERSION = '-v';
    private const HELP = '-h';
}
