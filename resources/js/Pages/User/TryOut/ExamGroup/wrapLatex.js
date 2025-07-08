// Helper to detect and wrap LaTeX-like expressions for MathJax
// Example: frac23+frac14×frac25 => $\frac{2}{3}+\frac{1}{4}\times\frac{2}{5}$

function convertLatexLikeToMathJax(str) {
    if (!str) return str;
    // Replace fracXY with \frac{X}{Y}
    let replaced = str.replace(
        /frac(\d+)(\d+)/g,
        (m, p1, p2) => `\\frac{${p1}}{${p2}}`
    );
    // Replace x or × with \times
    replaced = replaced.replace(/([0-9])\s*[x×]\s*([0-9])/g, "$1 \\times $2");
    // Optionally, add more rules for sqrt, etc.
    return replaced;
}

function wrapLatexInText(text) {
    if (!text) return text;
    // Only wrap if not already inside $...$
    // Find all latex-like expressions (frac, sqrt, etc.)
    // This is a simple heuristic, can be improved
    return text.replace(/(frac\d+\d+(?:[+\-x×*/]frac\d+\d+)*)/g, (match) => {
        // If already wrapped, skip
        if (/\$.*frac/.test(text)) return match;
        return `$${convertLatexLikeToMathJax(match)}$`;
    });
}

export { wrapLatexInText, convertLatexLikeToMathJax };
