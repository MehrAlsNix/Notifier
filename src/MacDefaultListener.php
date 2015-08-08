<?php
/**
 * Notifier
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @copyright 2015 MehrAlsNix (http://www.mehralsnix.de)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://github.com/MehrAlsNix/Notifier
 * @version   $Id$
 */

namespace MehrAlsNix\Notifier;

class MacDefaultListener extends NotificationBase
{
    /**
     * @param string $title
     * @param string $message
     * @return null
     */
    protected function notify($title, $message)
    {
        $this->execute("terminal-notifier -title '{$title}' -message '{$message}' -sender com.apple.Terminal");
    }

    /**
     * @return bool
     */
    public function isAvailable()
    {
        return $this->execute('which terminal-notifier');
    }
}
